async function buscarDados(dataInicio, dataFim) {
            // Define a URL com os parâmetros de data
            const url = `../../grafico.php`;
            const response = await fetch(url);
            return await response.json();
        }

        async function atualizarGrafico() {
    // Pega as datas dos inputs
    const dataInicio = document.getElementById('data_inicio').value || '2023-01-01';
    const dataFim = document.getElementById('data_fim').value || new Date().toISOString().slice(0, 10);

    // Busca os dados da API
    const dados = await buscarDados(dataInicio, dataFim);

    // Configura e exibe o gráfico
    const ctx = document.getElementById('meuGrafico').getContext('2d');

    // Verifica se o gráfico já existe antes de destruí-lo
    if (window.meuGrafico instanceof Chart) {
        window.meuGrafico.destroy();
    }

    // Cria um novo gráfico
    window.meuGrafico = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Realizado', 'Pendente'],
            datasets: [{
                data: [dados.realizado, dados.pendente],
                backgroundColor: ['#36a2eb', '#FF9F40']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Status de Pagamento'
                }
            }
        }
    });
}


        // Inicializa o gráfico ao carregar a página
        atualizarGrafico();