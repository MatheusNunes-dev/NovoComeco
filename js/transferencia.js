document.getElementById('filter-ong').addEventListener('change', validateFilters);
document.getElementById('start-date').addEventListener('change', validateFilters);
document.getElementById('end-date').addEventListener('change', validateFilters);

function validateFilters() {
    const startDate = document.getElementById('start-date').value;
    const endDate = document.getElementById('end-date').value;

    // Verificar se a data de início é posterior à data de término
    if (startDate && endDate && !isValidDateRange(startDate, endDate)) {
        showErrorMessage('A data de início não pode ser posterior à data de término.');
        return; // Impede a aplicação do filtro com erro
    }

    // Executa o filtro se as datas forem válidas
    filterDonations();
}

function isValidDateRange(startDate, endDate) {
    const start = new Date(startDate);
    const end = new Date(endDate);
    return start <= end;
}

function filterDonations() {
    const selectedOng = document.getElementById('filter-ong').value;
    const startDate = document.getElementById('start-date').value;
    const endDate = document.getElementById('end-date').value;
    const donationBoxes = document.querySelectorAll('.donation-box');

    let anyVisible = false; // Flag para verificar se alguma doação será exibida

    donationBoxes.forEach(box => {
        let show = true;
        const donationDate = box.getAttribute('data-date');
        const donationOng = box.getAttribute('data-ong');

        // Filtra por ONG
        if (selectedOng !== 'all' && selectedOng !== donationOng) {
            show = false;
        }

        // Filtra por data de início e término
        if (startDate && new Date(donationDate) < new Date(startDate)) {
            show = false;
        }
        if (endDate && new Date(donationDate) > new Date(endDate)) {
            show = false;
        }

        box.style.display = show ? 'block' : 'none';
        if (show) anyVisible = true; // Define a flag como verdadeira se algum elemento é visível
    });

    // Exibe um erro se nenhum resultado for encontrado
    if (!anyVisible) {
        showErrorMessage('Nenhuma doação encontrada para os filtros selecionados.');
    }
}

function showErrorMessage(message) {
    const errorMessageDiv = document.getElementById('error-message');
    const errorText = document.getElementById('error-text');
    errorText.textContent = message;
    errorMessageDiv.style.display = 'block'; // Exibe a mensagem de erro
}

function hideErrorMessage() {
    const errorMessageDiv = document.getElementById('error-message');
    errorMessageDiv.style.display = 'none';
}

document.getElementById('filter-ong').addEventListener('change', hideErrorMessage);
document.getElementById('start-date').addEventListener('change', hideErrorMessage);
document.getElementById('end-date').addEventListener('change', hideErrorMessage);
