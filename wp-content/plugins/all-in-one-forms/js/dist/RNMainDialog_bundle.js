rndefine("#RNMainDialog",["lit","#RNMainCore/LitElementBase","#RNMainLit/Lit","lit/decorators"],(function(e,t,i,o){"use strict";const n=(()=>{const e=["a[href]","area[href]",'input:not([disabled]):not([type="hidden"]):not([aria-hidden])',"select:not([disabled]):not([aria-hidden])","textarea:not([disabled]):not([aria-hidden])","button:not([disabled]):not([aria-hidden])","iframe","object","embed","[contenteditable]",'[tabindex]:not([tabindex^="-"])'];class t{constructor({targetModal:e,triggers:t=[],onShow:i=(()=>{}),onClose:o=(()=>{}),openTrigger:n="data-micromodal-trigger",closeTrigger:s="data-micromodal-close",openClass:l="is-open",disableScroll:a=!1,disableFocus:r=!1,awaitCloseAnimation:c=!1,awaitOpenAnimation:d=!1,debugMode:h=!1}){this.modal=e,this.config={debugMode:h,disableScroll:a,openTrigger:n,closeTrigger:s,openClass:l,onShow:i,onClose:o,awaitCloseAnimation:c,awaitOpenAnimation:d,disableFocus:r},t.length>0&&this.registerTriggers(...t),this.onClick=this.onClick.bind(this),this.onKeydown=this.onKeydown.bind(this)}registerTriggers(...e){e.filter(Boolean).forEach((e=>{e.addEventListener("click",(e=>this.showModal(e)))}))}showModal(e=null){if(this.activeElement=document.activeElement,this.modal.setAttribute("aria-hidden","false"),this.modal.classList.add(this.config.openClass),this.scrollBehaviour("disable"),this.addEventListeners(),this.config.awaitOpenAnimation){const e=()=>{this.modal.removeEventListener("animationend",e,!1),this.setFocusToFirstNode()};this.modal.addEventListener("animationend",e,!1)}else this.setFocusToFirstNode();this.config.onShow(this.modal,this.activeElement,e)}closeModal(e=null){const t=this.modal;if(this.modal.remove(),this.modal.setAttribute("aria-hidden","true"),this.removeEventListeners(),this.scrollBehaviour("enable"),this.activeElement&&this.activeElement.focus&&this.activeElement.focus(),this.config.onClose(this.modal,this.activeElement,e),this.config.awaitCloseAnimation){let e=this.config.openClass;this.modal.addEventListener("animationend",(function i(){t.classList.remove(e),t.removeEventListener("animationend",i,!1)}),!1)}else t.classList.remove(this.config.openClass)}closeModalById(e){this.modal&&this.closeModal()}scrollBehaviour(e){if(!this.config.disableScroll)return;const t=document.querySelector("body");switch(e){case"enable":Object.assign(t.style,{overflow:""});break;case"disable":Object.assign(t.style,{overflow:"hidden"})}}addEventListeners(){this.modal.addEventListener("touchstart",this.onClick),this.modal.addEventListener("click",this.onClick),document.addEventListener("keydown",this.onKeydown)}removeEventListeners(){this.modal.removeEventListener("touchstart",this.onClick),this.modal.removeEventListener("click",this.onClick),document.removeEventListener("keydown",this.onKeydown)}onClick(e){e.target.hasAttribute(this.config.closeTrigger)&&this.closeModal(e)}onKeydown(e){27===e.keyCode&&this.closeModal(e),9===e.keyCode&&this.retainFocus(e)}getFocusableNodes(){const t=this.modal.querySelectorAll(e);return Array(...t)}setFocusToFirstNode(){if(this.config.disableFocus)return;const e=this.getFocusableNodes();if(0===e.length)return;const t=e.filter((e=>!e.hasAttribute(this.config.closeTrigger)));t.length>0&&t[0].focus(),0===t.length&&e[0].focus()}retainFocus(e){let t=this.getFocusableNodes();if(0!==t.length)if(t=t.filter((e=>null!==e.offsetParent)),this.modal.contains(document.activeElement)){const i=t.indexOf(document.activeElement);e.shiftKey&&0===i&&(t[t.length-1].focus(),e.preventDefault()),!e.shiftKey&&t.length>0&&i===t.length-1&&(t[0].focus(),e.preventDefault())}else t[0].focus()}}let i=null;const o=e=>{if(!document.getElementById(e))return console.warn(`MicroModal: ❗Seems like you have missed %c'${e}'`,"background-color: #f8f9fa;color: #50596c;font-weight: bold;","ID somewhere in your code. Refer example below to resolve it."),console.warn("%cExample:","background-color: #f8f9fa;color: #50596c;font-weight: bold;",`<div class="modal" id="${e}"></div>`),!1},n=(e,t)=>{if((e=>{if(e.length<=0)console.warn("MicroModal: ❗Please specify at least one %c'micromodal-trigger'","background-color: #f8f9fa;color: #50596c;font-weight: bold;","data attribute."),console.warn("%cExample:","background-color: #f8f9fa;color: #50596c;font-weight: bold;",'<a href="#" data-micromodal-trigger="my-modal"></a>')})(e),!t)return!0;for(var i in t)o(i);return!0};return{init:e=>{const o=Object.assign({},{openTrigger:"data-micromodal-trigger"},e),s=[...document.querySelectorAll(`[${o.openTrigger}]`)],l=((e,t)=>{const i=[];return e.forEach((e=>{const o=e.attributes[t].value;void 0===i[o]&&(i[o]=[]),i[o].push(e)})),i})(s,o.openTrigger);if(!0!==o.debugMode||!1!==n(s,l))for(var a in l){let e=l[a];o.targetModal=a,o.triggers=[...e],i=new t(o)}},show:(e,n)=>{const s=n||{};s.targetModal=e,!0===s.debugMode&&!1===o(e)||(i&&i.removeEventListeners(),i=new t(s),e.ModalInstance=i,i.showModal())},close:e=>{e?i.closeModalById(e):i.closeModal()}}})();var s={};!function(e){Object.defineProperty(e,"__esModule",{value:!0});var t="times",i=[],o="f00d",n="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z";e.definition={prefix:"fas",iconName:t,icon:[352,512,i,o,n]},e.faTimes=e.definition,e.prefix="fas",e.iconName=t,e.width=352,e.height=512,e.ligatures=i,e.unicode=o,e.svgPathData=n}(s);var l,a,r,c,d,h,u,p={};function f(e,t){var i=Object.keys(e);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(e);t&&(o=o.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),i.push.apply(i,o)}return i}function m(e){for(var t=1;t<arguments.length;t++){var i=null!=arguments[t]?arguments[t]:{};t%2?f(Object(i),!0).forEach((function(t){babelHelpers.defineProperty(e,t,i[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(i)):f(Object(i)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(i,t))}))}return e}!function(e){Object.defineProperty(e,"__esModule",{value:!0});var t="check",i=[],o="f00c",n="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z";e.definition={prefix:"fas",iconName:t,icon:[512,512,i,o,n]},e.faCheck=e.definition,e.prefix="fas",e.iconName=t,e.width=512,e.height=512,e.ligatures=i,e.unicode=o,e.svgPathData=n}(p);let g=(l=o.query("footer"),a=o.query("header"),r=o.query("main"),c=class extends t.LitElementBase{static get properties(){return{applyIsBusy:{type:Boolean}}}constructor(){super(),this.DialogResult=null,this.applyIsBusy=!1,babelHelpers.initializerDefineProperty(this,"footer",d,this),babelHelpers.initializerDefineProperty(this,"header",h,this),babelHelpers.initializerDefineProperty(this,"main",u,this),this.Resized=this.Resized.bind(this)}SendResult(e){this.DialogResult=e,this.Close()}GetOptions(){return m({Title:"",Styles:null,HideHeader:!1,HideFooter:!1,CloseButtonTitle:"Close",CloseButtonIcon:s.faTimes,ShowCloseButton:!0,ShowApplyButton:!1,ApplyButtonTitle:"Apply",ApplyButtonIcon:p.faCheck,CloseOnClickingOut:!0,HideCrossButton:!1},this.InternalGetOptions())}GetParentClasses(){return"modal micromodal-slide"}connectedCallback(){super.connectedCallback(),window.addEventListener("resize",this.Resized)}disconnectedCallback(){super.disconnectedCallback(),window.removeEventListener("resize",this.Resized)}render(){let t=this.GetOptions();return e.html` <div class="modal__overlay rednao" tabindex="-1" ?data-micromodal-close="${!0===this.GetOptions().CloseOnClickingOut}"> <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title" style="${e.rnsg(m({},this.GetOptions().Styles))}"> ${i.rnIf(!this.GetOptions().HideHeader&&e.html` <header class="modal__header" style="display: flex;align-items: center;padding:16px;border-bottom: 1px solid #e9ecef;"> <h2 class="modal__title" id="modal-1-title"> ${t.Title} </h2> <button class="modal__close" aria-label="Close modal" style="display: flex;align-items: center;"> <rn-fontawesome @click="${this.Close}" .icon="${s.faTimes}" style="font-size: 18px;top:7px;right: 7px;"></rn-fontawesome> </button> </header> `)} ${i.rnIf(this.GetOptions().HideHeader&&!this.GetOptions().HideCrossButton&&e.html` <button class="modal__close" aria-label="Close modal" style="display: flex;align-items: center;position: absolute;top:10px;right:18px;padding: 0;z-index: 100000"> <rn-fontawesome @click="${this.Close}" .icon="${s.faTimes}" style="font-size: 18px;top:7px;right: 7px;"></rn-fontawesome> </button> `)} <main class="modal__content" id="modal-1-content" style="padding:16px;overflow: auto;margin: 0;max-height: ${this.CalculateMaxHeight()}"> ${this.SubRender()} </main> ${i.rnIf(!this.GetOptions().HideFooter&&e.html` <footer style="margin-top: 15px;display: flex;align-items: center;justify-content: flex-end;padding: 16px;border-top: 1px solid #e9ecef;" > ${i.rnIf(t.ShowCloseButton&&e.html` <button @click=${e=>this.Close()} class="rnbtn rnbtn-danger" style="display: flex;align-items: center"> <rn-fontawesome .icon=${t.CloseButtonIcon} style="margin-right: 3px"></rn-fontawesome> ${t.CloseButtonTitle} </button> `)} ${i.rnIf(t.ShowApplyButton&&e.html` <rn-spinner-button .label="${t.ApplyButtonTitle}" .icon="${t.ApplyButtonIcon}" .isBusy="${this.applyIsBusy}" @click="${e=>this.Apply()}" style="display: flex;align-items: center;margin-left: 5px"> </rn-spinner-button> `)} </footer> `)} </div> </div> `}Close(){this.ModalInstance.closeModal()}CalculateMaxHeight(){let e=0;return null!=this.footer&&(e+=this.footer.getBoundingClientRect().height),null!=this.header&&(e+=this.header.getBoundingClientRect().height),.8*(window.innerHeight-e)+"px"}firstUpdated(e){null!=this.main&&(this.main.style.maxHeight=this.CalculateMaxHeight()),super.firstUpdated(e)}Resized(){this.requestUpdate()}async OnApply(){return!0}async Apply(){this.applyIsBusy=!0;let e=await this.OnApply();this.applyIsBusy=!1,e&&this.Close()}},d=babelHelpers.applyDecoratedDescriptor(c.prototype,"footer",[l],{configurable:!0,enumerable:!0,writable:!0,initializer:null}),h=babelHelpers.applyDecoratedDescriptor(c.prototype,"header",[a],{configurable:!0,enumerable:!0,writable:!0,initializer:null}),u=babelHelpers.applyDecoratedDescriptor(c.prototype,"main",[r],{configurable:!0,enumerable:!0,writable:!0,initializer:null}),c);exports.Dialog=class{static async Show(t){return new Promise((i=>{let o=e.renderInline(t);o.setAttribute("aria-hidden","false"),document.body.appendChild(o),n.show(o,{onClose:()=>i(o.DialogResult)})}))}},exports.DialogBase=g}));