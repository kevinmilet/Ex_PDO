// Gestion du select pour choisir le nombre de patients à afficher

let selectPatient = document.querySelector('#limit');

if (selectPatient != undefined) {
    selectPatient.onchange = function () {
        let valuePatient = document.getElementById('limit').value;
        document.location.href = '/controllers/liste-patientsCtrl.php?limit=' + valuePatient;
    }
}


// Gestion du select pour choisir le nombre de rdv à afficher

let selectAptmt = document.querySelector('#limitAptmt');

if (selectAptmt != undefined) {
    selectAptmt.onchange = function () {
        let valueAptmt = document.getElementById('limitAptmt').value;
        document.location.href = '/controllers/liste-rendezvousCtrl.php?limitAptmt=' + valueAptmt;
    }
}

// let select = document.querySelector('#limit');

// if (select != undefined) {
//     select.onchange = function () {
//         let value = document.getElementById('limit').value;
//         document.location.href = '/controllers/paginationCtrl.php?pageType=' + pageType  + '&limit=' + value;
//     }
// }
