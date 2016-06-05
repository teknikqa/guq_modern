/*!
 * fitColumns layout mode for Isotope
 * http://isotope.metafizzy.co
 */
(function(e){"use strict";function t(e){var t=e.create("fitColumns");t.prototype._resetLayout=function(){this.x=0;this.y=0;this.maxX=0};t.prototype._getItemLayoutPosition=function(e){e.getSize();if(this.y!==0&&e.size.outerHeight+this.y>this.isotope.size.innerHeight){this.y=0;this.x=this.maxX}var t={x:this.x,y:this.y};this.maxX=Math.max(this.maxX,this.x+e.size.outerWidth);this.y+=e.size.outerHeight;return t};t.prototype._getContainerSize=function(){return{width:this.maxX}};t.prototype.needsResizeLayout=function(){return this.needsVerticalResizeLayout()};return t}if(typeof define==="function"&&define.amd){define(["isotope/js/layout-mode"],t)}else{t(e.Isotope.LayoutMode)}})(window)