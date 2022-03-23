<template>
    <div v-if="!loading" class="form-container">
    <b-form-group
        id="fieldset-1"
        description="Его вы увидите на кнопке перехода на чек-лист"
        label="Введите название для Чек-Листа"
        label-for="inputtext"
    >
        <b-form-input id="inputtext" required v-model="text_btn"  trim></b-form-input>
    </b-form-group>
        <b-form-group
            id="fieldset-1"
            label="Цвет кнопки Чек-листа"
            label-for="inputcolor"
        >
            <b-form-select id="inputcolor" required v-model="selectedColor" :options="colorOptions"></b-form-select>
        </b-form-group>

    <br>
        <b-card class="mx-3" v-for="card in cards" :title="'Вопрос №'+card" :key="card" sub-title="Создайте вопрос">

            <form>
                <b-form-group
                    id="fieldset-1"
                    description="Может быть Камера или Бампер"
                    label="Текст Вопроса"
                    :label-for="'input'+card"
                >
                    <b-form-input required :id="'input'+card" v-model="questions[card-1].question"  trim></b-form-input>
                </b-form-group>
                <b-row>

                    <b-col>
                        <h5>Текст Ответа на Вопрос</h5>
                    </b-col>
                    <b-col>
                        <h5>Выбрать Ответ для свайпа вправо</h5>
                    </b-col>


                </b-row>
                <b-row class="my-1" v-for="ans in questions[card-1].answers" :key="ans.id">

                    <b-col>

                            <b-form-input required :id="'input'+card" v-model="questions[card-1].answers[ans.id-1].text"  trim></b-form-input>

                    </b-col>
                    <b-col >
                        <b-form-group  v-slot="{ ariaDescribedby }">
                            <b-form-checkbox
                                v-on:change="manageISOK(card-1, ans.id-1)"
                                :id="'check'+ans.id+'q'+(card)"
                                v-model="questions[card-1].answers[ans.id-1].is_OK"
                                :name="'check'+ans.id+'q'+(card)"
                                :value="true"
                                :unchecked-value="false"
                            >
                                Выбрать
                            </b-form-checkbox>
                        </b-form-group>
                    </b-col>


                </b-row>
                <b-button v-on:click="addAnswer(card-1)" variant="success">Добавить Ответ</b-button>
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
            cards: [1],
            questions: [
                {
                    question: '',
                    answers: [
                        {id: 1,text: '', is_OK: true},
                        {id: 2,text: '', is_OK: false},
                    ]
                },
            ],
        }
    },
    methods:{
        send() {
            let data = {
                check_list_name: this.text_btn,
                color: this.selectedColor,
                questions: this.questions,
            };
            this.loading = true;
            axios.post('./api/admin/checklist/save', data)
            .then(function (response) {
                window.location.href = './admin/check-list/';
            }).catch(function (error) {
                console.log(error);
            })
        } ,
        manageISOK(q, ans){
            if (this.questions[q].answers[ans].is_OK == false) {
                this.questions[q].answers[ans].is_OK = true
            }  else {
            for (let answer in this.questions[q].answers) {

                    if (answer == ans) {
                        continue;
                    } else {
                        this.questions[q].answers[answer].is_OK = false;
                    }
                }

            }
        },
        addQuestion() {
            let obj =  {
                    question: '',
                    answers: [
                        {id: 1,text: '', is_OK: true},
                        {id: 2,text: '', is_OK: false},
                    ]
                };
            this.questions.push(obj);
            this.cards.push(this.cards.length+1);
        },
        addAnswer(id) {
            let ansid = this.questions[id].answers[this.questions[id].answers.length-1].id
            let obj={id: ansid+1 ,text: '', is_OK: false};
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
