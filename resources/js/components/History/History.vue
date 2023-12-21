<template>
    <div class="history-container">
        <h2>Calculation History</h2>
        <ul>
            <li v-for="(item, index) in history" :key="index">{{ item.expression + ' = ' + item.result }}</li>
        </ul>
    </div>
</template>

<script>
import History from "./History.ts";
import "./History.css";

export default History;
</script>
