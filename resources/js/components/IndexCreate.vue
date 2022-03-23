<template>
    <div v-if="!loading" class="form-container">
        <b-form-group
            id="fieldset-1"
            description="Его вы увидите на кнопке перехода на форму"
            label="Название кнопки"
            label-for="inputtext"
        >
            <b-form-input id="inputtext" required v-model="text_btn"  trim></b-form-input>
        </b-form-group>
        <b-form-group
            id="fieldset-1"
            label="Цвет кнопки"
            label-for="inputcolor"
        >
            <b-form-select id="inputcolor" required v-model="selectedColor" :options="colorOptions"></b-form-select>
        </b-form-group>

        <br>
        <b-card class="mx-3" v-for="card in cards" :title="'Вопрос №'+card" :key="card" sub-title="Создайте вопрос">

            <form>
                <b-form-group
                    id="fieldset-1"
                    description=""
                    label="Название Поля"
                    :label-for="'input'+card"
                >
                    <b-form-input required :id="'input'+card" v-model="questions[card-1].input"  trim></b-form-input>
                </b-form-group>
                <b-form-group
                    id="fieldset-1"
                    description="На английском, без пробелов. Должно быть уникальным"
                    label="Имя поля"
                    :label-for="'input'+card"
                >
                    <b-form-input required :id="'input'+card" v-model="questions[card-1].name"  trim></b-form-input>
                </b-form-group>
                <b-form-group
                    id="fieldset-1"
                    description=""
                    label="Вид Поля"
                    :label-for="'input'+card"
                >
                    <b-form-select id="inputtype" required v-model="questions[card-1].type" :options="typeOptions"></b-form-select>
                </b-form-group>
                <div v-if="questions[card-1].type === 'select'">
                <b-row>

                    <b-col>
                        <h5>Вариант ответа</h5>
                    </b-col>


                </b-row>
                <b-row class="my-1" v-for="ans in questions[card-1].answers" :key="ans.id">

                    <b-col>

                        <b-form-input required :id="'input'+card" v-model="questions[card-1].answers[ans.id-1].text"  trim></b-form-input>

                    </b-col>
                    <b-col>
                    </b-col>


                </b-row>
                <b-button v-on:click="addOption(card-1)" variant="success">Добавить Ответ</b-button>
                </div>
            </form>

        </b-card>
        <b-button v-on:click="addQuestion()" variant="success">Добавить Вопрос</b-button>
        <b-button class="mt-5" size="lg" v-on:click="send()" variant="warning">Сохранить</b-button>
    </div>
</template>

<script>
export default {
    name: "ChecklistCreate",
    data() {
        return {
            loading: false,
            text_btn: '',
            selectedColor: 'black',
            colorOptions: [
                {value: 'black', text: 'Черный', selected:true},
                {value: 'red', text: "Красный"},
                {value: 'green', text: "Зеленый"},
            ],
            typeOptions: [
                {value:'', text:''},
                {value:'select', text:'Селект (выбор одного варианта из предложенных)'},
                {value:'text', text:'Текст (небольшое поле для ввода строки)'},
                {value:'number', text:'Число'},
                {value:'textarea', text:'Текст (большое поле)'},
                {value:'checkbox', text:'Чек-Бокс (выбор Да/Нет) '},
            ],
            cards: [1],
            questions: [
                {
                    input: '',
                    name:'',
                    type: '',
                    answers: [
                        {id: 1,text: ''},
                    ]
                },
            ],
        }
    },
    methods:{
        send() {
            let data = {
                text_btn: this.text_btn,
                color: this.selectedColor,
                questions: this.questions,
            };
            this.loading = true;
            axios.post('/api/admin/index-page/save', data)
                .then(function (response) {
                    window.location.href = '/admin/index-page/';
                }).catch(function (error) {
                console.log(error);
            })
        } ,
        addQuestion() {
            let obj =  {
                question: '',
                answers: [
                    {id: 1,text: ''},
                ]
            };
            this.questions.push(obj);
            this.cards.push(this.cards.length+1);
        },
        addOption(id) {
            let ansid = this.questions[id].answers[this.questions[id].answers.length-1].id
            let obj={id: ansid+1 ,text: ''};
            this.questions[id].answers.push(obj);
        }
    }
}
</script>

<style scoped>
.form-container {
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    justify-content: center;
    width: 80%;
}
.mx-3 {
    margin: 20px 0;
}
</style>
