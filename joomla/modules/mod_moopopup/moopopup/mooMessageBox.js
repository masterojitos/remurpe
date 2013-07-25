var mooSimpleBox = new Class({
	options: {
		width: 		300,
		height: 	200,
		opacity:	'0.8',
		btnTitle:	"Ok",
		closeBtn:	null,
		boxTitle:	"messageBox",
		boxClass:	'mainBox',
		id:			'myID',
		fadeSpeed:	500,
		box:		null,
		addContentID:null,
		addContent:  null,
		boxTxtColor: '#000',
		isVisible:	false,
		isDrag:		true
	},
		
	initialize: function(options){
		this.isVisible = false;
		if(options['isDrag']) this.isDrag = options['isDrag'];
		if(options['width']) this.width = options['width'];
		if(options['height']) this.height = options['height'];
		if(options['opacity']) this.opacity = options['opacity'];
		if(options['btnTitle']) this.btnTitle = options['btnTitle'];
		if(options['boxTitle']) this.boxTitle = options['boxTitle'];
		if(options['boxClass']) this.boxClass = options['boxClass'];
		if(options['boxTxtColor']) this.boxTxtColor = options['boxTxtColor'];
		if(options['fadeSpeed']) this.fadeSpeed = options['fadeSpeed'];
		if(options['id']) this.id = options['id'];
		if(options['closeBtn']) this.closeBtn = $(options['closeBtn']);
		if(options['addContentID']) this.addContentID = options['addContentID'];
		
		if(options['addContentID']) {
			this.addContent = $(this.addContentID).innerHTML;
			$(this.addContentID).setStyle('visibility','hidden');
			$(this.addContentID).remove();
		}		
		
		this.createBox();	
	},
		
	createBox: function(){
		this.box = new Element('div');
		this.box.addClass(this.boxClass);
	},
	
	clickClose: function(){
		$(this.box).effect('opacity',{ wait:true, duration:this.fadeSpeed, transition:Fx.Transitions.linear }).chain(function(){
		}).start(this.opacity,0);
			this.isVisible = false;
		},
		
		fadeOut: function(){
			if(this.isVisible){
				$(this.box).effect('opacity',{ wait:true, duration:this.fadeSpeed, transition:Fx.Transitions.linear }).chain(function(){
			}).start(this.opacity,0);
			this.isVisible = false;
		}
			
	},
		
	fadeIn: function(){	
		if (document.documentElement && document.documentElement.clientWidth) {
			theWidth=document.documentElement.clientWidth;
		}else if (document.body) {
			theWidth=document.body.clientWidth;
		}
		if (window.innerHeight) {
			theHeight=window.innerHeight;
		}else if (document.documentElement && document.documentElement.clientHeight) {
			theHeight=document.documentElement.clientHeight;
		}else if (document.body) {
			theHeight=document.body.clientHeight;
		}
		var top = window.getScrollTop();
		var boxTop =  (theHeight - this.height) / 2 ;
        boxTop = (boxTop + top);
		var boxLeft = (theWidth - this.width) / 2;			
		this.box.setStyle('top',boxTop);
		this.box.setStyle('left',boxLeft);
		this.box.setStyle('position','absolute');
		this.box.setStyle('width',this.width);
		this.box.setStyle('height',this.height);
		this.box.setStyle('opacity',this.opacity);
		this.box.setStyle('cursor','move');
		this.box.setStyle('z-index','999990000');
		this.box.setAttribute('id', this.id);
		this.box.setStyle('visibility','hidden');
		this.box.injectInside(document.body);
		if(this.isVisible == false){
			this.box.effect('opacity',{ wait:true, duration: this.fadeSpeed, transition: Fx.Transitions.linear }).start(0,this.opacity);
			this.addHT();
			this.isVisible = true;
		}
	},
		
	addHT: function(){
		this.closeBtn = new Element('button', {
			styles: {
				'border': 'none',
				'background-image':'url(modules/mod_moopopup/moopopup/images/bg_button.gif)',
				'color':'#666',
				'position':'absolute',
				'bottom':'3px',
				'right':'3px',
				'width':'44px',
				'height':'19px',
				'font-size':'10px',
				'font-family':'arial',
				'cursor':'pointer'
			}				
		})
		
	  var width = this.width.toInt() + 5;
		if(window.ie){
			var titleBar = new Element('div', {
				styles: {
					'width' : 				width,
					'height': 				'auto',
					'background-repeat':	'repeat-x',
					'background-position':	'right top',
					'line-height':			'20px',
					'padding':				'5px 5px 5px 10px',
					'position':				'absolute',
					'clear':				'both',
					'margin-bottom':		'10px',
					'top':					'0px',
					'left':					'0px',
					'color':				'#eee'
				}
		  })
		}else{
			var titleBar = new Element('div', {
				styles: {
					'width' : 				width,
					'height': 				'auto',
					'background-repeat':	'repeat-x',
					'background-position':	'right top',
					'line-height':			'auto',
					'padding':				'5px 5px 5px 10px',
					'position':				'absolute',
					'clear':				'both',
					'margin-bottom':		'10px',
					'top':					'0px',
					'left':					'0px',
					'color':				'#eee'
				}
			})
		}
		
  	$(titleBar).innerHTML = this.boxTitle;
	
		var insideDiv = new Element('div',{
			styles: {
				'padding':'10px'
			}
		});
			
		insideDiv.setAttribute('id','myContent');
		this.box.innerHTML = "";
		insideDiv.injectInside(this.box);
	
		insideDiv.innerHTML = this.addContent;	
		this.closeBtn.innerHTML = this.btnTitle;	
		$(this.closeBtn).addEvent('click',this.clickClose.bindWithEvent(this));			
		titleBar.injectInside(this.box);
		this.closeBtn.injectInside(this.box);
			
		if(this.isDrag == 'true'){
			this.box.makeDraggable();
		}
	}
});

mooSimpleBox.implement(new Options, new Events);