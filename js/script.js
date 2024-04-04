function sidenavExpand() {
    document.getElementById('sideNav').style.left = "0px"
    document.getElementById('menu').setAttribute('onclick','sidenavColl()')
    document.getElementById('threebars').style.display = "none";
    document.getElementById('cross').style.display = "block";
}
function sidenavColl() {
    document.getElementById('sideNav').style.left = "-315px"
    document.getElementById('menu').setAttribute('onclick','sidenavExpand()')
    document.getElementById('threebars').style.display = "block";
    document.getElementById('cross').style.display = "none";
}