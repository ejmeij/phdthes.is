Ext.onReady(function(){
    var el = Ext.get('home-faq');
    
    var doFx = function(el, dir){
        var o = { useDisplay: true, duration: .3 };
        Ext.fly(el)['fade'+dir]({concurrent:true})['slide'+dir]('t', o);
    };
    
    if(el){
        el.on('click', function(e,t){
            t = e.getTarget('a', 1, true);
            if(t && !t.parent('.faq-a')){
                e.stopEvent();
                var href = t.dom.getAttribute('href'),
                    target = href.split('#')[1];
                
                if(this.prevTarget == target){
                    doFx(target, 'Out');
                    this.prevTarget = null;
                }
                else {
                    doFx(target, 'In');
                    if(this.prevTarget){
                        doFx(this.prevTarget, 'Out');
                    }
                    this.prevTarget = target;
                }
            }
            
        }, this);
    }
});
