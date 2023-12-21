<template>
    <div class="calculator-buttons">
        <button v-for="button in buttons" :key="button.label" @click="handleButtonClick(button.value)">
            {{ button.label }}
        </button>
        <button @click="sendCalculationRequest">Enter</button>
        <button @click="clear">C</button>
    </div>
</template>

<script>
import "./CalculatorButtons.css";

export default {
    props: {
        appendToExpression: Function,
        sendCalculationRequest: Function,
        clearExpression: Function,
    },
    data() {
        return {
            buttons: [
                {label: '1', value: '1'},
                {label: '2', value: '2'},
                {label: '3', value: '3'},
                {label: '4', value: '4'},
                {label: '5', value: '5'},
                {label: '6', value: '6'},
                {label: '7', value: '7'},
                {label: '8', value: '8'},
                {label: '9', value: '9'},
                {label: '0', value: '0'},
                {label: '+', value: '+'},
                {label: '-', value: '-'},
                {label: '*', value: '*'},
                {label: '/', value: '/'},
                {label: '(', value: '('},
                {label: ')', value: ')'},
                {label: '[', value: '['},
                {label: ']', value: ']'},
                {label: '{', value: '{'},
                {label: '}', value: '}'},
            ],
        };
    },
    methods: {
        handleButtonClick(value) {
            this.appendToExpression(value);
        },
        clear() {
            this.clearExpression();
        },
    },
};
</script>
