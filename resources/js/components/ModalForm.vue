<template>
    <div>
        <b-modal ref="my-modal" id="modal-center"
                 :cancel-disabled="true"
                 :ok-disabled="true"
                 centered
                 v-model="computed_open"
                 :hide-header-close="true"
                 :no-close-on-esc="true"
                 :no-close-on-backdrop="true"
        >
            <div class="d-block text-center">
                <h4 class="text-center">{{question['question']}}</h4>
                <b-form-group label="Что случилось?" v-slot="{ ariaDescribedby }">
                    <b-form-checkbox-group
                        id="btn-radios-3"
                        v-model="selected"
                        :options="options"
                        :aria-describedby="ariaDescribedby"
                        name="radio-btn-stacked"
                        button-variant="outline-primary"
                        size="lg"
                        buttons
                        stacked
                    ></b-form-checkbox-group>

                </b-form-group>
<!--                <div class="container" style="max-width: 60%">-->
<!--                <div class="input-group">-->
<!--                    <div class="custom-file">-->
<!--                        <input v-on:change="onFileUpload" type="file" class="custom-file-input" id="inputGroupFile04">-->
<!--                        <label style="text-align: left" class="custom-file-label" for="inputGroupFile04">Фото</label>-->
<!--                    </div>-->
<!--                </div>-->
<!--                </div>-->

<!--                <input type="file" v-on:change="onFileUpload">-->
            </div>

            <template #modal-footer>
            <div class="w-100">
                <b-button class="mt-3" variant="danger" block @click="sendAnswer()">ОТПРАВИТЬ</b-button>
            </div>
            </template>

        </b-modal>
    </div>
</template>

<script>
export default {
    props: {
        open:  {
            type: Boolean,
            default: false
        },
        question: {
            type: Object
        },
        session: {
            type: Number
        }
    },
    data() {
        return {

            selected: [],
            ShowModalWindow: false,
            options: [],
            file: null,
        }
    },
    methods: {
        onFileUpload(e) {
            this.file = e.target.files[0];
            console.log('file', e.target.files[0]);
        },
        getOptions() {
            this.options = [];
          for (let answer of this.question.answers) {
              let value = answer.id;
              let text = answer.text;
              let option = {text: text, value:value};
              if (answer.is_right_swipe !== 1)  {
                  this.options.push(option);
              }
          }
        },
        clearSelected() {
            this.selected = [];
        },
        sendAnswer() {
            let url = new URL(window.location.href)
            let checkid =  url.pathname.split('/')[2];
            let fd = new FormData();
            fd.append('img' ,this.file);
            console.log(fd);
            let self = this;
            axios.post('/api/checklists/'+checkid+'/question/'+this.question.id+'/answer/'+this.selected+"/session/"+this.session, fd)
                .then(function (response) {
                    console.log(response);
                    self.hideModal();
                    self.clearSelected();
                })
                .catch(function (error) {
                    alert(error.message);
                })

        },
        showModal() {
            this.$refs['my-modal'].show()
        },
        hideModal() {
            this.$refs['my-modal'].hide()
            this.$emit('close')
        },
        toggleModal() {
            // We pass the ID of the button that we want to return focus to
            // when the modal has hidden
            this.$refs['my-modal'].toggle('#toggle-btn')
        }
    },
    watch: {
        question: function (newVal, oldVal) {
            this.getOptions();
        },
        computed_open: function(newVal, oldVal) {
            if (newVal) {
                this.showModal()
            } else {
                this.$emit('close')
            }

        }
    },
    computed: {
        computed_open: {
            get(){
                return this.open
            },
            set(newName){
                return this.open
            }
        },
}

}
</script>

<style scoped>
.modal {
    background-color: white;
    width: 100%;
    height:60vh;
}

.inputfile {
    opacity: 0;
    width: 0.1px;
    height: 0.1px;
    position: absolute;
}
.label-file {
    display: block;
    position: relative;
    margin: 0 auto;
    width: 200px;
    height: 50px;
    border-radius: 25px;
    background: linear-gradient(40deg, #ff6ec4, #7873f5);
    box-shadow: 0 4px 7px rgba(0, 0, 0, 0.4);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-weight: bold;
    cursor: pointer;
    transition: transform .2s ease-out;
}
</style>
