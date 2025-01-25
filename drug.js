

const wrapper = document.querySelector(".wrapper"),
selectBtn = wrapper.querySelector(".select-btn"),
searchInp = wrapper.querySelector("input"),
options = wrapper.querySelector(".options");

let SystemicDrugs  = ["Antibiotics","Analgesics","Steroids","Antifungals","Antivirals", "Sedation"];


function addDrugs(selectedDrugs) {
    options.innerHTML = "";
    SystemicDrugs .forEach(Drugs => {
        let isSelected =Drugs == selectedDrugs ? "selected" : "";
        let li = `<li onclick="updateName(this)" class="${isSelected}">${Drugs}</li>`;
        options.insertAdjacentHTML("beforeend", li);
    });
}
addDrugs();

function updateName(selectedLi) {
    searchInp.value = "";
    addDrugs(selectedLi.innerText);
    wrapper.classList.remove("active");
    selectBtn.firstElementChild.innerText = selectedLi.innerText;
}
searchInp.addEventListener("keyup", () => {
    let arr = [];
    let searchWord = searchInp.value.toLowerCase();
    arr = SystemicDrugs .filter(data => {
        return data.toLowerCase().startsWith(searchWord);
    }).map(data => {
        let isSelected = data == selectBtn.firstElementChild.innerText ? "selected" : "";
        return `<li onclick="updateName(this)" class="${isSelected}">${data}</li>`;
    }).join("");
    options.innerHTML = arr ? arr : `<p style="margin-top: 10px;">Oops! Systemic Drugs not found</p>`;
});

selectBtn.addEventListener("click", () => wrapper.classList.toggle("active"));

///////////////////////////////////////////

// let Disease= ["Hyper-thyroidism","Hypo-thyroidism","Diabetes Mellitus","Hypertension","Heart failure", "Coronary heart disease (angina, myocardial infarction)" , "Pregnancy" , "G6PD deficiency anemia" , "Kidney disease" ,"Liver disease", "Bleeding and clotting disorders or patients on anti-platelets or anti-coagulants" , "Peptic ulcer" , "Bronchial asthma" , "Systemic Lupus erythematosus"];

// New box for Disease
const wrapperD = document.querySelector(".wrapperD"),
  selectBtnD = wrapperD.querySelector(".select-btn"),
  searchInpD = wrapperD.querySelector("input"),
  optionsD = wrapperD.querySelector(".options");

let Disease = ["Hyper-thyroidism", "Hypo-thyroidism", "Diabetes Mellitus", "Hypertension", "Heart failure", "Coronary heart disease (angina, myocardial infarction)", "Pregnancy", "G6PD deficiency anemia", "Kidney disease", "Liver disease", "Bleeding and clotting disorders or patients on anti-platelets or anti-coagulants", "Peptic ulcer", "Bronchial asthma", "Systemic Lupus erythematosus"];

function addDiseases(selectedDisease) {
  optionsD.innerHTML = "";
  Disease.forEach(Disease => {
    let isSelected = Disease == selectedDisease ? "selected" : "";
    let li = `<li onclick="updateNameD(this)" class="${isSelected}">${Disease}</li>`;
    optionsD.insertAdjacentHTML("beforeend", li);
  });
}
addDiseases();

function updateNameD(selectedLi) {
  searchInpD.value = "";
  addDiseases(selectedLi.innerText);
  wrapperD.classList.remove("active");
  selectBtnD.firstElementChild.innerText = selectedLi.innerText;
}

searchInpD.addEventListener("keyup", () => {
  let arr = [];
  let searchWord = searchInpD.value.toLowerCase();
  arr = Disease.filter(data => {
    return data.toLowerCase().startsWith(searchWord);
  }).map(data => {
    let isSelected = data == selectBtnD.firstElementChild.innerText ? "selected" : "";
    return `<li onclick="updateNameD(this)" class="${isSelected}">${data}</li>`;
  }).join("");
  optionsD.innerHTML = arr ? arr : `<p style="margin-top: 10px;">Oops! Disease not found</p>`;
});

selectBtnD.addEventListener("click", () => wrapperD.classList.toggle("active"));


