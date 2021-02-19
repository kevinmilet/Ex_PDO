// Gestion du select pour choisir le nombre de patients ou rdv à afficher

let select = document.querySelector('#limit');

if (select != undefined) {
    select.onchange = function () {
        let pageType = document.getElementById('pageType').value;
        let limit = document.getElementById('limit').value;
        document.location.href = '/controllers/paginationCtrl.php?pageType=' + pageType  + '&limit=' + limit;
    }
}
