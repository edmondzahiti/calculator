import {makeApiRequest} from "../../services/apiService";
import CalculatorButtons from "./parts/CalculatorButtons.vue";
import History from "../History/History.vue";
import {defineComponent, onMounted, ref} from 'vue';

export default defineComponent({
    name: "Calculator",
    components: {
        CalculatorButtons,
        History
    },
    setup() {
        const expression = ref("");
        const result = ref<any>(null);
        const history = ref<any[]>([]);

        const appendToExpression = (value: string) => {
            expression.value += value;
        };

        const clearExpression = () => {
            expression.value = '';
            result.value = '';
        };

        const sendCalculationRequest = async () => {
            try {
                const result = await makeApiRequest("calculate", "POST", {
                    expression: expression.value,
                });

                history.value.unshift({
                    'expression': result.data.expression,
                    'result': result.data.result
                });

                expression.value = "";
            } catch (error) {
                console.error("Error calculating:", error.message);
                result.value = "Error calculating";
            }
        };

        onMounted(async () => {
            try {
                const historyData = await makeApiRequest("history", "GET");
                history.value = historyData.data.map(item => ({
                    expression: item.expression,
                    result: item.result,
                }));

            } catch (error) {
                console.error("Error fetching history:", error.message);
            }
        });


        return {
            expression,
            result,
            history,
            clearExpression,
            appendToExpression,
            sendCalculationRequest,
        };
    },
});
