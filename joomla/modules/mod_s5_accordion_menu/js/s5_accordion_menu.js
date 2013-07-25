function s5_am_addJavascript(s5_am_jsname,s5_am_pos) {
var s5_am_th = document.getElementsByTagName(s5_am_pos)[0];
var s5_am_s = document.createElement('script');
s5_am_s.setAttribute('type','text/javascript');
s5_am_s.setAttribute('src',s5_am_jsname);
s5_am_th.appendChild(s5_am_s);
} 

if ($$.shared) {}

else {
s5_am_addJavascript('/media/system/js/mootools.js','head'); 
}


window.addEvent('domready', function(){

		if (s5_am_parent_link_enabled == "0") {
			var s5_am_parent_link = document.getElementById("s5_accordion_menu").getElementsByTagName("A");
			for (var s5_am_parent_link_y=0; s5_am_parent_link_y<s5_am_parent_link.length; s5_am_parent_link_y++) {
				if (s5_am_parent_link[s5_am_parent_link_y].parentNode.parentNode.tagName == "H3") {
					s5_am_parent_link[s5_am_parent_link_y].href = "javascript:;";
				}
			}
		}

		function s5_am_h3_background_load() {
			var s5_am_h3_close = document.getElementById("s5_accordion_menu").getElementsByTagName("H3");
			for (var s5_am_h3_close_y=0; s5_am_h3_close_y<s5_am_h3_close.length; s5_am_h3_close_y++) {
					s5_am_h3_close[s5_am_h3_close_y].className = "s5_am_toggler";
			}
			this.className = "s5_am_toggler s5_am_open";
		}
		
		var s5_am_h3_background = document.getElementById("s5_accordion_menu").getElementsByTagName("H3");
		for (var s5_am_h3_background_y=0; s5_am_h3_background_y<s5_am_h3_background.length; s5_am_h3_background_y++) {
				s5_am_h3_background[s5_am_h3_background_y].onclick = s5_am_h3_background_load;
		}
		
		var s5_am_element = document.getElementById("s5_accordion_menu").getElementsByTagName("DIV");
		for (var s5_am_element_y=0; s5_am_element_y<s5_am_element.length; s5_am_element_y++) {
			if (s5_am_element[s5_am_element_y].className == "s5_accordion_menu_element") {
				s5_am_element[s5_am_element_y].style.display = "block";
			}
		}
		
		var s5_am_current_level = 0;
		
		var s5_am_h3_current = document.getElementById("s5_accordion_menu").getElementsByTagName("H3");
		for (var s5_am_h3_current_y=0; s5_am_h3_current_y<s5_am_h3_current.length; s5_am_h3_current_y++) {
			if (s5_am_h3_current[s5_am_h3_current_y].id == "current") {
				s5_am_current_level = s5_am_h3_current_y;
			}
		}
		
		var s5_am_li_current = document.getElementById("s5_accordion_menu").getElementsByTagName("LI");
		for (var s5_am_li_current_y=0; s5_am_li_current_y<s5_am_li_current.length; s5_am_li_current_y++) {
			if (s5_am_li_current[s5_am_li_current_y].id == "current") {
				
				if (s5_am_li_current[s5_am_li_current_y].parentNode.parentNode.className == "s5_accordion_menu_element") {
					s5_am_li_current[s5_am_li_current_y].parentNode.parentNode.id = "s5_am_parent_div_current";
				}
				
				else if (s5_am_li_current[s5_am_li_current_y].parentNode.parentNode.parentNode.className == "s5_accordion_menu_element") {
					s5_am_li_current[s5_am_li_current_y].parentNode.parentNode.parentNode.id = "s5_am_parent_div_current";
				}
				
				else if (s5_am_li_current[s5_am_li_current_y].parentNode.parentNode.parentNode.parentNode.className == "s5_accordion_menu_element") {
					s5_am_li_current[s5_am_li_current_y].parentNode.parentNode.parentNode.parentNode.id = "s5_am_parent_div_current";
				}
				
				else if (s5_am_li_current[s5_am_li_current_y].parentNode.parentNode.parentNode.parentNode.parentNode.className == "s5_accordion_menu_element") {
					s5_am_li_current[s5_am_li_current_y].parentNode.parentNode.parentNode.parentNode.parentNode.id = "s5_am_parent_div_current";
				}
				
				var s5_am_div_current = document.getElementById("s5_accordion_menu").getElementsByTagName("DIV");
				for (var s5_am_div_current_y=0; s5_am_div_current_y<s5_am_div_current.length; s5_am_div_current_y++) {
					if (s5_am_div_current[s5_am_div_current_y].id == "s5_am_parent_div_current") {
						s5_am_current_level = s5_am_div_current_y - 1;
					}
				}
				
			}
		}


         s5_am_openElement = s5_am_current_level;

         var s5_accordion_menu = new Accordion($('s5_accordion_menu'), 'h3.s5_am_toggler', 'div.s5_accordion_menu_element', {
                opacity: true,
				allowMultipleOpen: true,
                display: s5_am_openElement,
				alwaysHide: true
         });
		 
		var s5_am_h3_first = document.getElementById("s5_accordion_menu").getElementsByTagName("H3");
		for (var s5_am_h3_first_y=0; s5_am_h3_first_y<s5_am_h3_first.length; s5_am_h3_first_y++) {
			if (s5_am_h3_first_y == s5_am_current_level) {
				s5_am_h3_first[s5_am_h3_first_y].className = "s5_am_toggler s5_am_open";
			}
		}
		 

 });
