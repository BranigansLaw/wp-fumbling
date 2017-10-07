(function() {   
tinymce.create('tinymce.plugins.WowShortcodes', {
 createControl : function(n, cm) {
    switch (n) {
    case 'mygallery_button':
      var c = cm.createMenuButton('mygallery_button', {
        title : 'My Shortcodes',
        icons : false
       });
       
     c.onRenderMenu.add(function(c, m) {
        var sub;
        m.add({title : 'Shortcodes', 'class' : 'mceMenuItemTitle'}).setDisabled(1);
                
        sub = m.addMenu({title : 'Columns'});
		sub.add({title : 'Row', onclick : function() {
         tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[row]' + tinyMCE.activeEditor.selection.getContent() + '[/row]'); 
        }});
        sub.add({title : 'One Half', onclick : function() {
         tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[span size="6"]' + tinyMCE.activeEditor.selection.getContent() + '[/span]'); 
        }});
        sub.add({title : 'One Third', onclick : function() {
         tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[span size="4"]' + tinyMCE.activeEditor.selection.getContent() + '[/span]'); 
        }});
        sub.add({title : 'One Fourth', onclick : function() {
         tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[span size="3"]' + tinyMCE.activeEditor.selection.getContent() + '[/span]'); 
        }});
		sub.add({title : 'One Sixth', onclick : function() {
         tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[span size="2"]' + tinyMCE.activeEditor.selection.getContent() + '[/span]'); 
        }});
		sub.add({title : 'Full', onclick : function() {
         tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[span size="12"]' + tinyMCE.activeEditor.selection.getContent() + '[/span]'); 
        }});
		
		sub = m.addMenu({title : 'Text features'});
		sub.add({title : 'Button', onclick : function() {
           tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[wow_button type="square" size="small" color="mainthemebgcolor/blue/green/orange/black/violet/red/yellow/teal" fancy="noshadow" url="#" icon="envelope" text="Download" blank="true/false"]');            
        }});      
		sub.add({title : 'Icon', onclick : function() {
           tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[wow_icon type="star" size="13"]');
        }});
		sub.add({title : 'Highlight', onclick : function() {
            tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[highlight]'+tinyMCE.activeEditor.selection.getContent()+'[/highlight]');  
        }});    
        sub.add({title : 'Highlight Bold', onclick : function() {
            tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[highlightbold]'+tinyMCE.activeEditor.selection.getContent()+'[/highlightbold]');  
        }});
		sub.add({title : 'List', onclick : function() {
           tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[wow_list style="check/circleok/arrow/star/doublearrow/chevron/hand/thumb/asterisk/circlearrow/circleplus/longarrow"]<li>Cars</li><li>Dolls</li>[/wow_list]');
        }});      
		sub.add({title : 'Notice', onclick : function() {
            tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[notice]'+tinyMCE.activeEditor.selection.getContent()+'[/notice]'); 
         }});
		sub.add({title : 'Color me', onclick : function() {
            tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[wow_colorme]'+tinyMCE.activeEditor.selection.getContent()+'[/wow_colorme]'); 
         }});
		sub.add({title : 'Fancy Title', onclick : function() {
           tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[[wow_title align="left/center" text="This is my title"]');
        }});
		sub.add({title : 'Lead Text', onclick : function() {
           tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[wow_lead][wow_h1]...my title[/wow_h1]'+tinyMCE.activeEditor.selection.getContent()+'[/wow_lead]');
        }});
		sub.add({title : 'H1', onclick : function() {
            tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[wow_h1]'+tinyMCE.activeEditor.selection.getContent()+'[/wow_h1]'); 
         }});
		sub.add({title : 'H2', onclick : function() {
            tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[wow_h2]'+tinyMCE.activeEditor.selection.getContent()+'[/wow_h2]'); 
         }});
		sub.add({title : 'H3', onclick : function() {
            tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[wow_h3]'+tinyMCE.activeEditor.selection.getContent()+'[/wow_h3]'); 
         }});
		sub.add({title : 'H4', onclick : function() {
            tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[wow_h4]'+tinyMCE.activeEditor.selection.getContent()+'[/wow_h4]'); 
         }});
		sub.add({title : 'H5', onclick : function() {
            tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[wow_h5]'+tinyMCE.activeEditor.selection.getContent()+'[/wow_h5]'); 
         }});
		
        sub = m.addMenu({title : 'Elements'});
		
		sub.add({title : 'Accordion', onclick : function() {
          tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[wow_accordion]<br />[wow_accordion_section title="Section 1"]<br />Accordion Content<br />[/wow_accordion_section]<br />[wow_accordion_section title="Section 2"]<br />Accordion Content<br />[/wow_accordion_section]<br />[/wow_accordion]'); 
        }});		
        sub.add({title : 'Accordion 2', onclick : function() {
            tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[collapsibles]<br/>[collapse title="Collapse 1" state="active"]…[/collapse]<br/>[collapse title="Copllapse 2"]…[/collapse]<br/>[collapse title="Copllapse 3"]…[/collapse]<br/>[/collapsibles]'); 
        }});
		sub.add({title : 'Table', onclick : function() {
            tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[table type="striped" cols=" #,First Name, Last Name, Username" data=" 1, Filip, Stefansson, filipstefansson, 2, Victor, Meyer, Pudge, 3, Måns, Ketola-Backe, mossboll"]'); 
        }});
		sub.add({title : 'Tabs', onclick : function() {
            tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[tabs]<br/>[tab title="Home"]…[/tab]<br/>[tab title="Profile"]…[/tab]<br/>[tab title="Messages"]…[/tab]<br/>[/tabs]'); 
        }});
		sub.add({title : 'Alert', onclick : function() {
            tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[wow_alert type="block/error/success/info" text="hello"]'); 
         }});
		sub.add({title : 'Toggle', onclick : function() {
            tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[wow_toggle title="Your title or question"]Your content or answer[/wow_toggle]');
        }});
        sub.add({title : 'Toggle Simple', onclick : function() {
            tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[toggle title="Toggle Title"]'+tinyMCE.activeEditor.selection.getContent()+'[/toggle]');
        }});
		sub.add({title : 'Testimonial Rotator (Footer)', onclick : function() {
            tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[wow_testimonial]<br/>[wow_quote name="John" imglink="#" text="text here"]<br/>[/wow_testimonial]');
        }});
		 sub.add({title : 'Progress Bars', onclick : function() {
            tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[wow_skills]<br/>[skill width="100%" icon="legal" text="Legal Issues"]<br/>[skill width="80%" icon="bolt" text="Economic Stuff"]<br/>[/wow_skills]');
        }});
		sub.add({title : 'Important', onclick : function() {
          tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[important title="help"]'+tinyMCE.activeEditor.selection.getContent()+'[/important]'); 
        }});
        sub.add({title : 'Inset Left', onclick : function() {
          tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[insetleft title="help"]'+tinyMCE.activeEditor.selection.getContent()+'[/insetleft]'); 
        }});
        sub.add({title : 'Inset Right', onclick : function() {
          tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[insetright title="help"]'+tinyMCE.activeEditor.selection.getContent()+'[/insetright]'); 
        }});      
		
		sub = m.addMenu({title : 'Boxes and Panels '});
		sub.add({title : 'Simple Panel', onclick : function() {
          tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[wow_panel]' + tinyMCE.activeEditor.selection.getContent() + '[/wow_panel]'); 
        }});
		sub.add({title : 'Shadow Panel', onclick : function() {
          tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[wow_panel1]' + tinyMCE.activeEditor.selection.getContent() + '[/wow_panel1]'); 
        }});
		sub.add({title : 'Action Panel', onclick : function() {
          tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[wow_actionpanel icon="link" actiontext="Download" link="#"]' + tinyMCE.activeEditor.selection.getContent() + '[/wow_actionpanel]'); 
        }});		
		sub.add({title : 'Team Box', onclick : function() {
          tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[wow_teambox name="John Doe" position="Manager at WowThemes" description="Description here" imglink="#"]<br/>[wow_social icon="facebook" link="#"]<br/>[wow_social icon="twitter" link="#"]<br/>[/wow_teambox]'); 
        }});		
		sub.add({title : 'Box Shadows', onclick : function() {
          tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[wow_boxsh effect="2"]' + tinyMCE.activeEditor.selection.getContent() + '[/wow_boxsh]'); 
        }});
		sub.add({title : 'Colored Boxes', onclick : function() {
          tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[wow_box color="olive/blue/green/red/gray/yellow/white" float="left/right/none" text_align="left/right/center" width="100%"]' + tinyMCE.activeEditor.selection.getContent() + '[/wow_box]'); 
        }});
		sub.add({title : 'FancyBox1', onclick : function() {
          tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[wow_fancybox1 title="My Title" icon="star" hidelink="yes/no" link=""]' + tinyMCE.activeEditor.selection.getContent() + '[/wow_fancybox1]'); 
        }});
		sub.add({title : 'FancyBox2', onclick : function() {
          tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[wow_fancybox2 icon="star" title="My Title" ]' + tinyMCE.activeEditor.selection.getContent() + '[/wow_fancybox2]');
        }});
		sub.add({title : 'FancyBox3', onclick : function() {
          tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[wow_fancybox3 icon="microphone" title="My Title" description="my description here" linktext="contact us" linkurl="#"]'); 
        }});
		sub.add({title : 'Pricing Boxes', onclick : function() {
          tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[wow_pricing_table size="span3"]<br/>[wow_pricing plan="Gold" featured="no" cost="$29.99" per="per month" button_url="#" button_text="Sign Up" button_target="self" button_rel="nofollow"]<ul><li>5 products</li><li>1 image per product</li><li>basic stats</li><li>non commercial</li></ul>[/wow_pricing]<br/>[/wow_pricing_table]'); 
        }});
		sub.add({title : 'Call to Action', onclick : function() {
          tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[wow_callaction title="Hello" description="some description" btn1="Get Theme" btn1icon="shopping-cart" btn1link="#" btn2="Learn More" btn2icon="microphone" btn2link="#"]'); 
        }});		
				
		
		sub = m.addMenu({title : 'Sliders'});
		sub.add({title : 'Camera Slider', onclick : function() {
         tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[wow_slider]<br/>[wow_image link="imgfulllink.jpg"  showtext="no"]<br/>[wow_image link="imgfulllink2.jpg" showtext="no"]<br/>[wow_image link="imgfulllink3etc.jpg" title="title here" text="short text there" fadefrom="Left" targetlink="#"]<br/>[/wow_slider]'); 
        }});
		sub.add({title : 'Flex Slider', onclick : function() {
         tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[wow_flexslider]<br/>[wow_fleximage link="fulllinktopic1.jpg"]<br/>[wow_fleximage link="fulllinktopic2.jpg"]<br/>[/wow_flexslider]'); 
        }});
		sub.add({title : 'Content Slider', onclick : function() {
         tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[wow_contentslider]<br/>[wow_slidertext title="Title 1" text="some text here 1"]<br/>[wow_slidertext title="Title 2" text="some text here 2"]<br/>[wow_slidertext title="Title 3" text="some text here 3"]<br/>[/wow_contentslider]'); 
        }});
		
          
        sub = m.addMenu({title : 'Misc'});
		sub.add({title : 'Services', onclick : function() {
          tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[wow_wrapservices]<br/>[wow_sbox title="Title" icon="star" link="#" moretext="Read more"]content here...[/wow_sbox]<br/>[wow_sbox title="Title" icon="star" link="#" moretext="Read more"]content here...[/wow_sbox]<br/>[wow_sbox title="Title" icon="star" link="#" active="yes" moretext="Read more"]content here...[/wow_sbox]<br/>[wow_sbox title="Title" icon="star" link="" moretext="Read more"]content here...[/wow_sbox]<br/>[/wow_wrapservices]'); 
        }});
		sub.add({title : 'Recent Portfolio', onclick : function() {
          tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[wow_recentportfolio]'); 
        }});
		sub.add({title : 'Recent Posts', onclick : function() {
          tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[wow_recentposts bloglink="#"]'); 
        }});
		sub.add({title : 'Contact', onclick : function() {
          tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[wow_contact email=youraddress@email.com]'); 
        }});
        sub.add({title : 'Clear', onclick : function() {
         tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[wow_clear]'); 
        }});
		sub.add({title : 'Spacing', onclick : function() {
         tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[wow_spacing size="20px"]'); 
        }});
        sub.add({title : 'Divider', onclick : function() {
         tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[wow_divider]'); 
        }});
		sub.add({title : 'Google Map', onclick : function() {
         tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[wow_googlemap width="100%" height="480px" src="Your Map Full Url"]'); 
        }});
		sub.add({title : 'Private Content', onclick : function() {
          tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[wow_member].' + tinyMCE.activeEditor.selection.getContent() + '[/wow_member]'); 
        }});
    });
    
            return c;
        }
    return null;
    }
}); 

    tinymce.PluginManager.add('mygallery', tinymce.plugins.WowShortcodes);  

})();
