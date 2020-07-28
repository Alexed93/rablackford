/**
 * Responsive SVG IE
 *
 * Make SVGs scale predictably in IE 10/11
 * to match modrn browsers.
 *
 * This function loops through all SVG elements and -
 * Gets the aspect ratio of the SVG from the last 2 viewBox Properties
 * Sets the aspectRatio var as the height percentage compared to width
 * Removes width and height properties from the SVG as these values prevent responsiveness
 * Create a new Div and wrap the SVG
 * Set the aspect ratio of the wrapper div
 *
 */
function responsiveSvgIe(){
    var svgs = document.getElementsByTagName("svg");

    for(var i = 0; i < svgs.length; i++){
        var svg = svgs[i],
            viewBox = svg.getAttribute('viewBox').split(/\s+|,/),
            svgClass = svg.getAttribute('class'),
            aspectRatio = (viewBox[3] / viewBox[2]) * 100 + '%';

        svg.removeAttribute("width");
        svg.removeAttribute("height");

        var wrapper = document.createElement('div');

        if(svgClass) {
            wrapper.className = svgClass;
        }

        svg.parentNode.insertBefore(wrapper, svg);
        svg.style.position = 'absolute';
        wrapper.appendChild(svg);
        wrapper.style.paddingBottom = aspectRatio;
        wrapper.style.position = 'relative';
        wrapper.style.textAlign = 'left';
        //wrapper.style.backgroundColor = 'black';
    }
}

(function(){
    responsiveSvgIe();
})();
