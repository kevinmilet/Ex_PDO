let pageType = document.getElementById('pageType').value;

// Gestion du select pour choisir le nombre de patients ou rdv à afficher

let select = document.querySelector('#limit');

if (select != undefined) {

    select.onchange = function () {

        let limit = document.getElementById('limit').value;
        document.location.href = '/controllers/paginationCtrl.php?pageType=' + pageType  + '&limit=' + limit;

    }
}

// Gestion confirmation suppression patient et rdv

let delBtn = document.querySelectorAll('.del-btn');

delBtn.forEach(element => {

    let dataId = element.getAttribute('data');

    element.addEventListener('click', function(event) {
        
        switch (pageType) {
            case '1':
                let location1 = '/controllers/liste-patientsCtrl.php?id=' + dataId + '=&delete=1';
                document.getElementById('confirm1').setAttribute('href', location1);
                break;
            case '2':
                let location2 = '/controllers/liste-rendezvousCtrl.php?id=' + dataId + '=&delete=1';
                document.getElementById('confirm2').setAttribute('href', location2);
                break;
            default:
                document.location.href='/index.php';
        }
    })
})
