$(document).ready(function () {
    $('.navbar-dark .dmenu').hover(function () {
        $(this).find('.sm-menu').first().stop(true, true).slideDown(150);
    }, function () {
        $(this).find('.sm-menu').first().stop(true, true).slideUp(105)
    });
});

$('.close-btn').click(function () {
    $('.alert').animate({top: '-200px'}, 200);
});
$('.title').click(function (event) {
    var id = event.target.id;
    if ($('#id-' + id).css('display') == 'none') {
        $('#id-' + id).removeClass('unactive');
        $('#id-' + id).addClass('active');
    } else {
        $('#id-' + id).removeClass('active');
        $('#id-' + id).addClass('unactive');
    }
})

x = document.getElementsByClassName("custom-select");
l = x.length;
for (i = 0; i < l; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  ll = selElmnt.length;
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < ll; j++) {
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        var y, i, k, s, h, sl, yl;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        sl = s.length;
        h = this.parentNode.previousSibling;
        for (i = 0; i < sl; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            yl = y.length;
            for (k = 0; k < yl; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
    e.stopPropagation();
    closeAllSelect(this);
    this.nextSibling.classList.toggle("select-hide");
    this.classList.toggle("select-arrow-active");
  });
}
var x, i, j, l, ll, selElmnt, a, b, c;

function closeAllSelect(elmnt) {
  var x, y, i, xl, yl, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  xl = x.length;
  yl = y.length;
  for (i = 0; i < yl; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < xl; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}

document.addEventListener("click", closeAllSelect);


//  license deleting  //
$('#delete-license').click(function(){
  var license = $(this).closest('tr');
  var licenseName = license.find('.name').html();
  var firstname = $('#firstname').html();
  var lastname = $('#lastname').html();
  location.href = `obywatel.php?person=${firstname}+${lastname}&license=${licenseName}`;
})

//  delete bolo   //
$('#delete-bolo').click(function(){
  var tr = $(this).closest('tr');
  var dane = tr.find('.dane').html();
  location.href = `bolo.php?dane=${dane}`;
})

// delete dispatch
$('#delete-dispatch').click(function(){
  var tr = $(this).closest('tr');
  var dane = tr.find('.caller').html();
  location.href = `wezwania.php?dane=${dane}`;
})

// add callsign dispatch //
$('#add-dispatch').click(function(){
  var tr = $(this).closest('tr');
  var dane = tr.find('.caller').html();
  console.log(dane)
  location.href = `wezwania.php?add=${dane}`;
})

// refresh dispatch //
$('.refresh').click(function(){
  location.href = 'wezwania.php';
})