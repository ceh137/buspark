<template>
    <div>

        <div v-if="finished && qrValidated" class="container finished-view text-center">
            <h2>Вы закончили заполнение чек-листа для автобуса <strong>{{busNum}}</strong></h2>
            <div class="d-grid gap-2">
            <a href="http://localhost/checks" class="btn btn-primary btn-lg">Перейти к<br>Чек-Листам</a>
            </div>
        </div>
        <div v-if="!qrValidated" :class="{ 'fullscreen': fullscreen }" ref="wrapper" @fullscreenchange="onFullscreenChange">
            <qrcode-stream :torch="torchActive" @init="logErrors" @decode="onDecode">
                <button class="torch-button" @click="torchActive = !torchActive" :disabled="torchNotSupported">
                    <i v-if="!torchActive" class="bi bi-lightbulb"></i>
                    <i v-if="torchActive" class="bi bi-lightbulb-off"></i>
                </button>
                <button @click="fullscreen = !fullscreen" class="fullscreen-button">
                    <i v-if="!fullscreen" class="bi bi-fullscreen"></i>
                    <i  v-if="fullscreen" class="bi bi-fullscreen-exit"></i>
                </button>
            </qrcode-stream>
        </div>


    <vue-swing
        v-if="qrValidated && showCards"
        @throwout="onThrowout"
        :config="config"
        ref="vueswing"
    >
        <div
            v-for="card in cards"
            v-on:touchstart="touchStart($event)"
            v-on:touchmove="touchEnd($event)"
            :key="card.id"
            class="card"
        >
            <span>{{ card['question'] }}</span>
        </div>
    </vue-swing>
    <ModalForm
        v-on:close="ModalClosed()"
        :open="open"
        :question="currentCard"
        :session="session"
    ></ModalForm>
    </div>
</template>

<script>
import VueSwing from "vue-swing";
import ModalForm from "./ModalForm";
export default {
    name: "Test",
    props: {
        user: {
            type: Number
        }
    },
    components: {
        VueSwing,
        ModalForm,
    },
    data () {
        return {
            cameraClose: false,
            picture: '',
            showCards: true,
            finished: false,
            session: 0,
            torchNotSupported:false,
            torchActive: false,
            fullscreen: true,
            qrValidated: true,
            open: false,
            currentCard: {},
            config: {
                allowedDirections: [
                    VueSwing.Direction.LEFT,
                    VueSwing.Direction.RIGHT,
                ],
                minThrowOutDistance: 400,
                maxThrowOutDistance:2000,
                throwOutConfidence: (xOffset, yOffset, element) => {
                    const xConfidence = Math.min(Math.abs(this.XPath) / 150, 1);
                    return Math.max(xConfidence);
                }
            },
            coordEndX: 0,
            coordStartX: 0,
            coordEndY: 0,
            coordStartY: 0,
            questions: [],
            cards: [],
            cards_count: 0,
            busNum: "123456",
        }
    },
    methods: {
        onDecode(DecodedString)  {
            let obj = JSON.parse(DecodedString);
            if (!obj.busNum)  {
                alert("Код не верен");
            } else {
                this.busNum = obj.busNum;
                this.qrValidated = true;

                this.makeCheckSession();
            }


        },
        makeCheckSession() {
            let url = new URL(window.location.href)
            let checkid =  url.pathname.split('/')[2];
            let self = this;
            let bus = self.busNum;
            let user = self.user;
            axios.get('/api/checklists/'+checkid+'/bus_number/'+bus+'/user/'+user)
                .then(function (response) {
                    self.session = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                })
        },
        async onInit (promise) {
            // show loading indicator

            try {
                const { capabilities } = await promise

                // successfully initialized
            } catch (error) {
                if (error.name === 'NotAllowedError') {
                    alert("Разрешите доступ к камере")
                    // user denied camera access permisson
                } else if (error.name === 'NotFoundError') {
                    // no suitable camera device installed
                    alert("Не поддерживаем такую камеру")
                } else if (error.name === 'NotSupportedError') {
                    // page is not served over HTTPS (or localhost)
                    alert("Нужен HTTPS протокол")
                } else if (error.name === 'NotReadableError') {
                    // maybe camera is already in use
                    alert("Возможно, камера уже используется")
                } else if (error.name === 'OverconstrainedError') {
                    // did you requested the front camera although there is none?
                    alert("Возможно, камера уже используется")
                } else if (error.name === 'StreamApiNotSupportedError') {
                    // browser seems to be lacking features
                    alert("Браузер не поддерживает такой функционал")
                }
            } finally {
                // hide loading indicator
            }
        },
        ModalClosed() {
            console.log('closed');
            this.open = false;
        },
        add () {
            this.cards.push(`${this.cards.length + 1}`)
        },
        remove () {
            this.swing()
            // setTimeout(() => {
            //     this.cards.pop()
            // }, 100)
        },
        swing () {
            const cards = this.$refs.vueswing.cards
            cards[cards.length - 1].throwOut(
                Math.random() * 100 - 50,
                Math.random() * 100 - 50
            )
        },
        onThrowout ({ target, throwDirection }) {
            console.log(throwDirection.toString())
            console.log(this.open);
            this.cards_count++;
            let popped  =  this.cards.pop();
            this.currentCard = popped;
            console.log(this.cards, this.cards_count);
            if (throwDirection.toString() === "Symbol(LEFT)") {
                this.open = true;
                this.cameraClose = false;
                console.log(this.open)
                if (this.cards.length  === 0) {
                    setTimeout(this.sendSessionToGoogle(), 500);
                }
            } else if (throwDirection.toString() === "Symbol(RIGHT)") {
                this.cameraClose = false;
                this.sendOKAnswer(popped.id)
                if (this.cards.length  === 0) {
                    setTimeout(this.sendSessionToGoogle(), 500);
                }
            }
        },
        touchStart(e)  {
            e.preventDefault();
            this.coordStartX = e.touches[0].pageX;
            this.coordStartY = e.touches[0].pageY;
        },
        touchEnd(e) {
            e.preventDefault();
            this.coordEndX = e.touches[0].pageX;
            this.coordEndY = e.touches[0].pageY;
        },
        downloadQuestions() {
            let url = new URL(window.location.href)
            let checkid =  url.pathname.split('/')[2];
            console.log(checkid);
            let self = this;
            axios.get('/api/checklists/'+checkid+'/questions')
            .then(function (response) {
                self.cards = response.data.reverse();
                console.log(response.data);
            })
            .catch(function (error) {
                console.log(error);
            })
        },
        sendOKAnswer(id)  {
            let url = new URL(window.location.href)
            let checkid =  url.pathname.split('/')[2];
            let self = this;
            axios.get('/api/checklists/'+checkid+'/question/'+id+'/OK/session/'+self.session)
                .then(function (response) {
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error);
                })
        },
        onFullscreenChange(event) {
            // This becomes important when the user doesn't use the button to exit
            // fullscreen but hits ESC on desktop, pushes a physical back button on
            // mobile etc.

            this.fullscreen = document.fullscreenElement !== null
        },
        sendSessionToGoogle() {
            let url = new URL(window.location.href)
            let checkid =  url.pathname.split('/')[2];
            let self = this;
            axios.get('/api/checklists/'+checkid+'/session/'+this.session)
                .then(function (response) {
                    self.finished =true;
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error);
                })
        },
        requestFullscreen() {
            const elem = this.$refs.wrapper

            if (elem.requestFullscreen) {
                elem.requestFullscreen();
            } else if (elem.mozRequestFullScreen) { /* Firefox */
                elem.mozRequestFullScreen();
            } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari and Opera */
                elem.webkitRequestFullscreen();
            } else if (elem.msRequestFullscreen) { /* IE/Edge */
                elem.msRequestFullscreen();
            }
        },

        exitFullscreen() {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.mozCancelFullScreen) { /* Firefox */
                document.mozCancelFullScreen();
            } else if (document.webkitExitFullscreen) { /* Chrome, Safari and Opera */
                document.webkitExitFullscreen();
            } else if (document.msExitFullscreen) { /* IE/Edge */
                document.msExitFullscreen();
            }
        },
        logErrors (promise) {
            promise.catch(console.error)
        }
    },
    computed: {
        XPath: function () {
            return this.coordEndX - this.coordStartX;
        },
        YPath: function () {
            return this.coordEndY - this.coordStartY;
        },
        cameraShown: function () {
            if (Math.min(Math.abs(this.YPath) / 150, 1) === 1) {
                return true;
            } else {
                return false;
            }

        }
    },
    mounted: function() {
        this.downloadQuestions();
        this.makeCheckSession();
    },
    watch: {
        fullscreen(enterFullscreen) {
            if (enterFullscreen) {
                this.requestFullscreen()
            } else {
                this.exitFullscreen()
            }
        },
    }
}
</script>

<style scoped>
.card {
    align-items: center;
    background-color: #fff;
    border-radius: 20px;
    box-shadow: 0 2px 5px rgba(256, 256, 256, 0.1);
    display: flex;
    padding: 20px;
    font-size: 4vh;
    height: 60vh;
    font-weight: bold;
    text-align: center;
    justify-content: center;
    left: calc(50% - 35%);
    position: absolute;
    top: calc(50% - 25%);
    width: 70%;
}
.qr-scanner-enter-block {
    width: 100%;
    height: 100%;

}
.fullscreen {
    position: fixed;
    z-index: 1000;
    top: 5vh;
    bottom: 5vh;
    right: 3vh;
    left: 3vh;
}
.fullscreen-button {
    background-color: white;
    position: absolute;
    bottom: 10px;
    right: 10px;

}
.torch-button {
    position: absolute;
    left: 10px;
    top: 10px;
}
</style>
