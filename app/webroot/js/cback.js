function color1() {
	var box = document.getElementById('t1');
	var color = box.options[box.selectedIndex].text;
	box.style.backgroundColor = color;
	box.options[0].style.backgroundColor = '#FFFFFF';
	//box.style.color = '#FFFFFF';
}
function color2() {
	var box = document.getElementById('t2');
	var color = box.options[box.selectedIndex].text;
	box.style.backgroundColor = color;
	box.options[0].style.backgroundColor = '#FFFFFF';
	//box.style.color = '#FFFFFF';
}

function color() {
	color1();
	color2();
}

window.onload = color;
