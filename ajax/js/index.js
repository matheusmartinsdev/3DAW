const IBGE_API_URL = 'https://servicodados.ibge.gov.br/api/v1/localidades/estados';

async function loadStates() {
    const states = await fetch(IBGE_API_URL)
        .then(response => response.json())
        .then(states => states)

    return states.map(({ id, sigla, nome }) => ({
        id,
        name: nome,
        initials: sigla
    }));
}

async function loadCitiesFromState(state) {
    const cities = await fetch(`${IBGE_API_URL}/${state}/municipios`)
        .then(response => response.json())
        .then(cities => cities)

    return cities.map(({ nome }) => nome);
}

async function fillStates(states) {
    const selectStates = document.getElementById('states');
    for (state of states) {
        selectStates.innerHTML += `<option value="${state.id}">${state.initials}</option>`;
    }
}

async function fillCities(cities) {
    const selectCities = document.getElementById('cities');
    selectCities.innerHTML = '';
    for (city of cities) {
        selectCities.innerHTML += `<li>${city}</li>`;
    }
}

window.addEventListener('load', async (event) => {
    const states = await loadStates();
    await fillStates(states);
    document.querySelector('#states').disabled = false;
});

document.querySelector('#states').addEventListener('change', async (event) => {
    const state = event.target.value;
    const cities = await loadCitiesFromState(state);
    fillCities(cities);
});