// Gestion du select pour choisir le nombre de patients ou rdv à afficher

let select = document.querySelector('#limit');

if (select != undefined) {

    select.onchange = function () {

        let pageType = document.getElementById('pageType').value;
        let limit = document.getElementById('limit').value;
        document.location.href = '/controllers/paginationCtrl.php?pageType=' + pageType  + '&limit=' + limit;

    }
}

// Gestion confirmation suppression patient et rdv

let delBtn = document.querySelectorAll('.del-btn');

const modal = document.getElementById('patient-del-confirm');

delBtn.forEach(element => {

    let dataId = element.getAttribute('data');
    
    element.addEventListener('click', function(event) {
        
        let location = '/controllers/liste-patientsCtrl.php?id=' + dataId + '=&delete=1';
        document.getElementById('confirm').setAttribute('href', location);

    });
});
