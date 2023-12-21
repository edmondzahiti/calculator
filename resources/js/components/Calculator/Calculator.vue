<template>
    <div class="calculator-container">
        <div class="calculator">
            <div class="calculator-input">
                <input
                    v-model="expression"
                    placeholder="Enter expression"
                    @keydown.enter="sendCalculationRequest"
                />
            </div>
            <CalculatorButtons
                :appendToExpression="appendToExpression"
                :sendCalculationRequest="sendCalculationRequest"
                :clearExpression="clearExpression"
            />
            <div class="calculator-result">
                <p>Result: {{ result }}</p>
            </div>
        </div>
        <History :history="history"/>
    </div>
</template>

<script>
import Calculator from "./Calculator.ts";
import "./Calculator.css";

export default Calculator;

</script>
