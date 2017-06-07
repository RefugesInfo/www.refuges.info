L.Control.EasyPrint = L.Control.extend({
	options: {
		title: 'Print map',
		position: 'topleft',
		A4Landscape: true,
		A4Portrait: true
	},

	onAdd: function () {
		
		var container = L.DomUtil.create('div', 'leaflet-control-easyPrint leaflet-bar leaflet-control');
		L.DomEvent.addListener(container, 'mouseover', displayPageSizeButtons, this);
		L.DomEvent.addListener(container, 'mouseout', hidePageSizeButtons, this);

		this.link = L.DomUtil.create('a', 'leaflet-control-easyPrint-button leaflet-bar-part', container);
		this.link.id = "leafletEasyPrint";
		this.link.title = this.options.title;

		this.holder = L.DomUtil.create('ul', 'easyPrintHolder', container );
		
		if (this.options.A4Landscape === true){
			this.landscape = L.DomUtil.create('li', 'easyPrintLandscape leaflet-bar-part', this.holder);
			this.landscape.innerHTML = "Landscape";
			L.DomEvent.addListener(this.landscape, 'click', printLandscapePage, this);
		}
		if (this.options.A4Portrait === true){
			this.portrait = L.DomUtil.create('li', 'easyPrintPortrait leaflet-bar-part', this.holder);
			this.portrait.innerHTML = "Portrait";
			L.DomEvent.addListener(this.portrait, 'click', printPortraitPage, this);
		}

		return container;
	}

});

L.easyPrint = function(options) {

	if(options.A4Landscape === false && options.A4Portrait === false){
		console.warn("Leaflet Easy Print Warning: You can not have both A4Landscape & A4Portrait set to false");
		return null;
	}

	return new L.Control.EasyPrint(options);
};

function displayPageSizeButtons(){
	this.link.style.borderTopRightRadius = "0px";
	this.link.style.borderBottomRightRadius = "0px";
	
	if(this.options.A4Portrait){
		this.portrait.style.display = "inline-block";
	}
	if(this.options.A4Landscape){
		this.landscape.style.display = "inline-block";
	}
	
	this.holder.style.marginTop = "-"+this.link.clientHeight-1+"px";
	this.holder.style.marginLeft = this.link.clientWidth+"px";
}

function hidePageSizeButtons(){
	this.link.style.borderTopRightRadius = "";
	this.link.style.borderBottomRightRadius = "";

	if(this.options.A4Portrait){
		this.portrait.style.display = "";	
	}
	if(this.options.A4Landscape){
		this.landscape.style.display = "";
	}

	this.holder.style.marginTop = "";
	this.holder.style.marginLeft = "";
}

function printLandscapePage(){
	this.printSize = "Landscape";
	printA4Page(this);
}

function printPortraitPage(){
	this.printSize = "Portrait";
	printA4Page(this);
}

function printA4Page(easyPrintObj){

	var map = easyPrintObj._map.getContainer();
	var originalmapWidth = map.style.width;
	var originalmapHeight = map.style.height;

	var head = document.getElementsByTagName('head')[0];
	var printStyleSheet = document.createElement('style');
	printStyleSheet.setAttribute('type', 'text/css');
	head.appendChild(printStyleSheet);


	if(easyPrintObj.printSize == "Landscape"){
		map.style.width = "1045px";
		map.style.height = "715px";	
		printStyleSheet.innerText = "@media print { @page { size : landscape; }}";
	}
	if(easyPrintObj.printSize == "Portrait"){
		map.style.width = "715px";
		map.style.height = "1040px";
		printStyleSheet.innerText = "@media print { @page { size : portrait; }}";
	}

	var origCenter = easyPrintObj._map.getCenter();
	var origZoom = easyPrintObj._map.getZoom();

	var htmlElementsToHide = document.querySelectorAll("*");  

	for (var i = 0; i < htmlElementsToHide.length; i++) {
		var classname = htmlElementsToHide[i].className;

		if(typeof classname === 'string' || classname instanceof String){
			if(classname.search("leaflet") == -1 )
			{
				htmlElementsToHide[i].className = htmlElementsToHide[i].className + ' _epHidden';
			}
		}
	}	

	var body = document.getElementsByTagName("body")[0];
	body.className = body.className.replace(' _epHidden','');

	var html = document.getElementsByTagName("html")[0];
	html.className = html.className.replace(' _epHidden','');

	easyPrintObj._map.invalidateSize();
	easyPrintObj._map.setView(origCenter);
	easyPrintObj._map.setZoom(origZoom);

	window.print();


	for (var i = 0; i < htmlElementsToHide.length; i++) {
		var classname = htmlElementsToHide[i].className;

		if(typeof classname === 'string' || classname instanceof String){
			htmlElementsToHide[i].className = htmlElementsToHide[i].className.replace(' _epHidden','');
		}
	}

	map.style.width = originalmapWidth;
	map.style.height = originalmapHeight;

	easyPrintObj._map.invalidateSize();
	easyPrintObj._map.setView(origCenter);
	easyPrintObj._map.setZoom(origZoom);	

	head.removeChild(printStyleSheet);
}