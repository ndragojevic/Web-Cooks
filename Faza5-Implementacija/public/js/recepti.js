/*
    autor : Nikola Jovanovic
    indeks : 2019/0440
*/
const rate = () => {
    console.log('rate');
}

const addCategoryTag = (tagName) => {
    document.getElementById("tags").append(tagName+",");
    console.log(tagName);
}

const filterRecepiesByGroceries = () => {
    alert("Filtriraj recepte po namirnicama iz kuce")
}

const showFavorites = () => {
    alert("Prikazi omiljene recepte!");
} 