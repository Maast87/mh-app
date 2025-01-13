<script setup>
    import Layout from "../Shared/Layout.vue";
    import {Head, Link} from "@inertiajs/vue3";
    import {provide, onMounted} from "vue";
    import ProfileLayout from "@/Pages/Shared/ProfileLayout.vue";
    import { Chart } from 'chart.js/auto';
    import GradientElement from "@/Components/PageLayoutElements/GradientElement.vue";
    import GradientWhiteElement from "@/Components/PageLayoutElements/GradientWhiteElement.vue";

    Chart.defaults.font.family = "'Montserrat', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, 'Noto Sans', sans-serif";
    Chart.defaults.font.size = 14;
    Chart.defaults.font.weight = '400';
    Chart.defaults.color = '#0E122C';

    const breadcrumbs = [
        { label: "home", href: "/" },
        { label: "profiel", href: "/profiel" },
        { label: "resultaten" }
    ];
    provide('breadcrumbs', breadcrumbs);

    const props = defineProps({
        requestedTagname: String,
        belastbaarheidScores: Array,
        testScores: Array,
    });

    const getFormattedDateParts = (dateString) => {
        const date = new Date(dateString);
        return {
            day: date.getDate().toString().padStart(2, '0'),
            month: (date.getMonth() + 1).toString().padStart(2, '0'),
            year: date.getFullYear().toString().slice(-2),
            hours: date.getHours().toString().padStart(2, '0'),
            minutes: date.getMinutes().toString().padStart(2, '0')
        };
    };

    const formatDate = (dateString) => {
        const { day, month, year } = getFormattedDateParts(dateString);
        return `${day}-${month}-${year}`;
    };

    const formatDateWithTime = (dateString) => {
        const { day, month, year, hours, minutes } = getFormattedDateParts(dateString);
        return `${day}-${month}-${year}, ${hours}:${minutes}`;
    };

    const createChart = (ctx, scores, label) => {
        if (ctx && scores && scores.length > 0) {
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: scores.map(score => formatDate(score.created_at)),
                    datasets: [{
                        label: label,
                        data: scores.map(score => score.score),
                        borderColor: '#fff',
                        backgroundColor: '#2EA186',
                        borderRadius: {
                            topLeft: 8,
                            topRight: 8,
                            bottomLeft: 0,
                            bottomRight: 0
                        },
                        borderSkipped: false
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: '← Score →',
                                font: {
                                    weight: '700'
                                }
                            },
                            ticks: {
                                color: '#0E122C'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: '← Datum →',
                                font: {
                                    weight: '700'
                                }
                            },
                            ticks: {
                                color: '#0E122C'
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            padding: 12,
                            titleSpacing: 8,
                            bodySpacing: 8,
                            boxPadding: 6,
                            callbacks: {
                                title: (tooltipItems) => {
                                    const dataIndex = tooltipItems[0].dataIndex;
                                    return formatDateWithTime(scores[dataIndex].created_at);
                                }
                            }
                        },
                        legend: {
                            labels: {
                                font: {
                                    size: 14,
                                    weight: '600'
                                },
                                color: '#0E122C',
                                padding: 25,
                                usePointStyle: true,
                                pointStyle: 'rectRounded'
                            },
                            padding: {
                                bottom: 160
                            },
                        },
                        title: {
                            font: {
                                weight: '700'
                            },
                            color: '#0E122C'
                        }
                    }
                }
            });
        }
    };

    onMounted(() => {
        createChart(document.getElementById('belastbaarheidChart'), props.belastbaarheidScores, 'Belastbaarheid score');
        createChart(document.getElementById('testChart'), props.testScores, 'Test score');
    });
</script>

<template>
    <Layout>
        <Head title="Profiel resultaten" />

        <div class="flex flex-col w-full">
            <ProfileLayout :requestedTagname="requestedTagname" />
            
            <div class="flex w-full gap-x-4 bg-gray-100 rounded-xl mb-6">
                <GradientElement class="flex flex-col w-full gap-y-4">
                    <GradientWhiteElement v-if="belastbaarheidScores && belastbaarheidScores.length > 0" class="w-full !p-0 !gap-y-0">
                        <div class="flex bg-blue-700 rounded-xl justify-center items-center py-2">
                            <p class="text-header_s text-gray-100 text-center">Belastbaarheid resultaten</p>
                        </div>
                        <div class="pr-4 pl-3 pb-2">
                            <canvas id="belastbaarheidChart"></canvas>
                        </div>
                    </GradientWhiteElement>
                    <GradientWhiteElement v-if="testScores && testScores.length > 0" class="w-full !p-0 !gap-y-0">
                        <div class="flex bg-blue-700 rounded-xl justify-center items-center py-2">
                            <p class="text-header_s text-gray-100 text-center">Test resultaten</p>
                        </div>
                        <div class="pr-4 pl-3 pb-2">
                            <canvas id="testChart"></canvas>
                        </div>
                    </GradientWhiteElement>
                </GradientElement>
            </div>
        </div>
    </Layout>
</template>