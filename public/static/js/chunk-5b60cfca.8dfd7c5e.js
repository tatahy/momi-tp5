(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-5b60cfca"],{"0acc":function(t,e,n){},4529:function(t,e,n){"use strict";var r=n("0acc"),i=n.n(r);i.a},"9d6c":function(t,e,n){"use strict";n.r(e);var r=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("b-container",{staticClass:"top56px",attrs:{fluid:""}},[t.showSidebar?n("div",{staticClass:"bg-white border-right h-100 \n\t\t\t\tsidenav sidenav-show sidenav-show-up",class:"border-"+t.themeClr},[t._t("leftSide")],2):t._e(),n("div",{staticClass:"content",style:t.setMarginLeft},[n("div",{staticClass:"py-2"},[n("b-button",{class:t.btnCls,attrs:{variant:"outline-"+t.themeClr},on:{click:t.sidebarDis}},[n("font-awesome-icon",{attrs:{icon:["fas",t.showSidebar?"angle-double-left":"angle-double-right"]}})],1)],1),n("header",[t._t("header")],2),n("main",{staticClass:"text-center"},[t.isBriefContent?[n("TheChart",{attrs:{"chart-id":"myChart","chart-type":"horizontalBar"}})]:[n("TheTable")]],2),n("footer",[t._t("footer")],2)]),n("div",{class:t.showDrop?"sidenav-backdrop":"",on:{click:t.backdropHide}})])},i=[],a=(n("a4d3"),n("4de4"),n("4160"),n("e439"),n("dbb4"),n("b64b"),n("d3b7"),n("159b"),n("2fa7")),o=n("41b0"),s=n("6278"),c={tag:{type:String,default:"div"},fluid:{type:Boolean,default:!1}},d=o["a"].extend({name:"BContainer",functional:!0,props:c,render:function(t,e){var n=e.props,r=e.data,i=e.children;return t(n.tag,Object(s["a"])(r,{class:{container:!n.fluid,"container-fluid":n.fluid}}),i)}}),b=n("583a"),h=n("08c1"),u=n("79c0"),l=n("fd53"),f=n("3e31");function p(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);e&&(r=r.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),n.push.apply(n,r)}return n}function w(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?p(n,!0).forEach((function(e){Object(a["a"])(t,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):p(n).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))}))}return t}l["c"].add(u["a"],u["b"]);var v={name:"TheContainer",data:function(){return{showDrop:!0,showSidebar:!0,btnCls:"font24px py-0 px-2"}},computed:w({setMarginLeft:function(){return{marginLeft:this.showSidebar?"200px":"0px"}}},Object(h["e"])({isBriefContent:function(t){return t.isBriefContent}}),{},Object(h["c"])({themeClr:"actNavThemeClr"})),methods:{backdropHide:function(){return this.showDrop=!this.showDrop,this.sidebarHide()},sidebarShow:function(){this.showSidebar=!0,this.showDrop=!0},sidebarHide:function(){this.showSidebar=!1},sidebarDis:function(){return this.showSidebar?this.sidebarHide():this.sidebarShow()},showAdvice:function(t){alert(t)}},components:{"b-container":d,"b-button":b["a"],FontAwesomeIcon:f["a"],TheChart:function(){return n.e("chunk-139a9a24").then(n.bind(null,"9d4e"))},TheTable:function(){return n.e("chunk-06e71596").then(n.bind(null,"dc7e"))}}},O=v,C=(n("4529"),n("2877")),g=Object(C["a"])(O,r,i,!1,null,"32ff82d4",null);e["default"]=g.exports}}]);
//# sourceMappingURL=chunk-5b60cfca.8dfd7c5e.js.map