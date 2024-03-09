rndefine("#RNMainDropdownField",["#RNMainCore/EventManager","#RNMainFormBuilderCore/FieldBase.Options","#RNMainFormBuilderCore/MultipleOptionsBase.Options","#RNMainFormBuilderCore/FormBuilder.Options","#RNMainFormBuilderCore/MultipleOptionsBase.Model","lit","#RNMainFormBuilderCore/MultipleOptionsBase","lit/decorators","#RNMainFormBuilderCore/IconDirective","lit-html/directives/live.js","lit/directives/repeat.js"],(function(e,l,i,t,o,s,n,d,r,a,u){"use strict";class p extends i.MultipleOptionsBaseOptions{LoadDefaultValues(){super.LoadDefaultValues(),this.Label="Dropdown",this.Placeholder="Select a value",this.Icon=(new t.IconOptions).Merge(),this.Type=l.FieldTypeEnum.DropDown}}class h extends o.MultipleOptionsBaseModel{render(){return s.html` <rn-dropdown-field .model="${this}"></rn-dropdown-field> `}get AllowMultiple(){return!1}ToggleSelection(e,l){let i=this.OptionItemsToUse.find((l=>l.Id==e));if(null==i)return void(this.AllowMultiple||(this.SelectedValues=[],this.FireValueChanged()));let t=this.SelectedValues.slice(0);this.AllowMultiple||(t=[]),l&&-1==t.indexOf(i.Id)&&t.push(i.Id),!l&&t.indexOf(i.Id)>=0&&t.splice(t.indexOf(i.Id),1),t.length>0&&this.RemoveError("required"),this.SelectedValues=t,this.FireValueChanged()}get IsReadonly(){var e,l,i;return null==this.FormBuilder||!1===(null===(e=this.RootFormBuilder)||void 0===e||null===(l=e.AdditionalOptions)||void 0===l||null===(i=l.EditOptions)||void 0===i?void 0:i.AllowEdition)}}var c;let m=d.customElement("rn-dropdown-field")(c=class extends n.MultipleOptionsBase{SubRender(){return s.html` <div style="position: relative;"> <select ${r.IconDirective(this.model.Options.Icon)} ?disabled=${this.model.IsReadonly} @focus=${()=>{this.model.IsFocused=!0,this.model.Refresh()}} @blur=${()=>{this.model.IsFocused=!1,this.model.Refresh()}} class='rnInputPrice' placeholder=${this.model.Options.Placeholder} style="width:100%" value=${a.live(0==this.model.SelectedValues.length?"":this.model.SelectedValues[0])} @change=${e=>this.OnChange(e)}> <option value="">${this.model.Options.Placeholder}</option> ${u.repeat(this.model.OptionItemsToUse,(e=>e.Id),(e=>s.html` <option ?selected="${this.model.SelectedValues[0]==e.Id}" .value=${e.Id}>${_rnt(e.Label)}</option> `))} </select> </div> `}OnChange(e){this.model.ToggleSelection(e.target.value,!0)}})||c;e.EventManager.Subscribe("GetFieldOptions",(e=>{if(e==l.FieldTypeEnum.DropDown)return new p})),e.EventManager.Subscribe("GetFieldModel",(e=>{if(e.Options.Type==l.FieldTypeEnum.DropDown)return new h(e.Options,e.Parent)})),exports.DropdownField=m,exports.DropdownFieldModel=h,exports.DropdownFieldOptions=p}));