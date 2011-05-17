.flash filename="action.swf" bbox=510x410
.font Times "times.swf"
.edittext name font=Times size=60% width=400 height=40 color=green border multiline wordwrap text=""
.text title font=Times size=60% text="Answer the question for a chance to win 100 Tradebux!"
.text question font=Times size=60% text="What's your favorite color?"
.text submit font=Times size=60% text="Submit!"
.box mybox color=blue fill=green width=100 height=100
.button mybutton1
	.show mybox as=shape
	.show mybox as=hover
	.on_press:
		GetURL("../submitname.php?value=" + name.text, "_self");
	.end
.end
.put title x=3 y=53
.put question x=3 y=153
.put name x=3 y=203
.put mybutton1 x=303 y=273
.put submit x=323 y=323
.end
