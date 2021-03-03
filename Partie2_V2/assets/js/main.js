let pageType = document.getElementById('pageType').value;

// Gestion du select pour choisir le nombre de patients ou rdv à afficher

let select = document.querySelector('#limit');

if (select != undefined) {

    select.onchange = function () {

        let limit = document.getElementById('limit').value;
        document.location.href = '/controllers/paginationCtrl.php?pageType=' + pageType + '&limit=' + limit;

    }
}



//************************************************************** */

// window.addEventListener('scroll', function() {
//     let height = window.innerHeight;

//     if (scrollY > (height - 600)) {

//         fetch('/test.php')
//             .then(response => response.json())
//             .then(data => listPatients(data))
//             .catch(error => console.log(`Erreur : ${error}`));
//     }
// })

// function listPatients(listPatients) {
//     console.log(listPatients);
// }

(function () {
    const patientsEl = document.querySelector('.tbody');
    let currentPage = 1;

    const limit = 10;

    let total = 0;

    // récuperer la liste des patients
    const listPatients = async (page, limit) => {
        const URL = `test.php?ajax=1&page=${page}&limit=${limit}`;
        const response = await fetch(URL);

        if (!response.ok) {
            throw new Error(`Une erreur est survenue: ${response.status}`);
        }
        const patients = await response.json();
        // return patients;
        showPatients(patients);
    }

    // Afficher les patients
    const showPatients = (patients) => {
        patients.forEach(patient => {
            const patientEl = document.createElement('tr');
            
            patientEl.innerHTML = `
        <td><a type="button" class="btn btn-primary btn-sm"
        href="/controllers/profil-patientCtrl.php?id=${patient.id}"><i
            class="far fa-user-edit"></i></a></td>
        <td>${patient.id}</th>
        <td>${patient.lastname}</td>
        <td>${patient.firstname}</td>
        <td>${patient.birthdate}</td>
        <td>${patient.phone}</td>
        <td>${patient.mail}</td>
        <td><button type="button" class="btn del-btn" data-mdb-toggle="modal" data-mdb-target="#patient-del-confirm" data="${patient.id}"><i class="fas fa-minus-circle text-danger"></i></a></td>
        `;

            patientsEl.appendChild(patientEl);
        });
    };

    // const hideLoader = () => {
    //     loader.classList.remove('show');
    // };

    // const showLoader = () => {
    //     loader.classList.add('show');
    // };

    

    const hasMorePatients = (page, limit, total) => {
        const startIndex = (page - 1) * limit + 1;
        return total === 0 || startIndex < total;
    };

    // chargment patients
    const loadPatients = async (page, limit) => {
        // affichage loader
        // showLoader();
        setTimeout(async () => {
            try {
                // si il y a encore des patients à récuperer
                if (hasMorePatients(page, limit, total)) {
                    // appel de l'url pour récupérer les patients
                    const response = await listPatients(page, limit);
                    // affichage des patients
                    showPatients(response.data);
                    // mise à jour total
                    total = response.total;
                }
            } catch (error) {
                console.log(error.message);
                // } finally {
                //     hideLoader();
                // }
            }
        }, 500);
    };



    window.addEventListener('scroll', () => {
        const {
            scrollTop,
            scrollHeight,
            clientHeight
        } = document.documentElement;
        
        if (scrollTop + clientHeight >= scrollHeight - 5 && hasMorePatients(currentPage, limit, total)) {
            currentPage++;
            loadPatients(currentPage, limit);
        }
    }, {
        passive: true

    });

    loadPatients(currentPage, limit);

})();


// Gestion confirmation suppression patient et rdv

let delBtn = document.querySelectorAll('.del-btn');

delBtn.forEach(element => {

    let dataId = element.getAttribute('data');

    element.addEventListener('click', function (event) {

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
                document.location.href = '/index.php';
        }
    })
})