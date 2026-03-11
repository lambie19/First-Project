// const ten = "Đỗ Danh Hoàng";

// console.log(ten.split(" "));


const Hovaten = ["Đỗ Danh Hoàng", "Phạm Tiến Dũng", "Mai Đức Duy", "Lê Duy Dương", "Nguyễn Gia Bảo"];
const nameArr = [];
for (let i = 0; i < Hovaten.length; i++) {
    let ten = Hovaten[i].split(" ");
    nameArr.push(ten[ten.length - 1]);
}
nameArr.sort();
console.log(nameArr);