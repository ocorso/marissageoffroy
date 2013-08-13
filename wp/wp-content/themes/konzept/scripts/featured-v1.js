/* 
Name: featured box flower theme
Author: flower */

function showBigImg(id) {
	for (i=0;i<5;i++) {
		if (i == id) {
			document.getElementById('img_big_'+i).style.visibility = 'visible';
		} else {
			document.getElementById('img_big_'+i).style.visibility = 'hidden';
		}
	}
}
