<template>
</template>
<script>
import ModalForm from './ModalForm'


export default {
    name: 'Modal',
    props: {
        open: {
          type: Boolean
        },
        question: {
            type: Object
        }
    },
    methods: {
        openModal() {
            this.$FModal.show(
                {
                    component: ModalForm
                },
                {
                    heading: this.question.question,
                    answers: this.question.answers
                }
            )
        }
    },
    watch: {
        open: function(newVal, oldVal) {
            this.openModal()
        }
    }
}
</script>
