document.getElementById('filter-ong').addEventListener('change', function() {
    var selectedValue = this.value;  // Obtém o valor selecionado do filtro
    var donationBoxes = document.querySelectorAll('.donation-box');  // Seleciona todas as caixas de doação

    // Itera sobre todas as caixas de doação
    donationBoxes.forEach(function(box) {
        var ong = box.getAttribute('data-ong');  // Obtém a ONG associada à caixa de doação

        // Se a opção for "all", exibe todas as doações
        if (selectedValue === 'all') {
            box.style.display = 'block';
        } else {
            // Caso contrário, filtra com base na ONG
            if (ong === selectedValue) {
                box.style.display = 'block';
            } else {
                box.style.display = 'none';
            }
        }
    });
});
