(function(A){
    A.jScrollPane={
        active:[]
    };A.fn.jScrollPane=function(C){
        C=A.extend({},A.fn.jScrollPane.defaults,C);var B=function(){
            return false
            };return this.each(function(){
            var O=A(this);O.css("overflow","hidden");var X=this;if(A(this).parent().is(".jScrollPaneContainer")){
                var Ac=C.maintainPosition?O.position().top:0;var L=A(this).parent();var d=L.innerWidth();var Ad=L.outerHeight();var M=Ad;A(">.jScrollPaneTrack, >.jScrollArrowUp, >.jScrollArrowDown",L).remove();O.css({
                    top:0
                })
                }else{
                var Ac=0;this.originalPadding=O.css("paddingTop")+" "+O.css("paddingRight")+" "+O.css("paddingBottom")+" "+O.css("paddingLeft");this.originalSidePaddingTotal=(parseInt(O.css("paddingLeft"))||0)+(parseInt(O.css("paddingRight"))||0);var d=O.innerWidth();var Ad=O.innerHeight();var M=Ad;O.wrap(A("<div></div>").attr({
                    className:"jScrollPaneContainer"
                }).css({
                    height:Ad+"px",
                    width:d+"px"
                    }));A(document).bind("emchange",function(Ae,Af,p){
                    O.jScrollPane(C)
                    })
                }if(C.reinitialiseOnImageLoad){
                var N=A.data(X,"jScrollPaneImagesToLoad")||A("img",O);var G=[];if(N.length){
                    N.each(function(p,Ae){
                        A(this).bind("load",function(){
                            if(A.inArray(p,G)==-1){
                                G.push(Ae);N=A.grep(N,function(Ag,Af){
                                    return Ag!=Ae
                                    });A.data(X,"jScrollPaneImagesToLoad",N);C.reinitialiseOnImageLoad=false;O.jScrollPane(C)
                                }
                            }).each(function(Af,Ag){
                            if(this.complete||this.complete===undefined){
                                this.src=this.src
                                }
                            })
                        })
                    }
                }var o=this.originalSidePaddingTotal;var l={
                height:"auto",
                width:d-C.scrollbarWidth-C.scrollbarMargin-o+"px"
                };if(C.scrollbarOnLeft){
                l.paddingLeft=C.scrollbarMargin+C.scrollbarWidth+"px"
                }else{
                l.paddingRight=C.scrollbarMargin+"px"
                }O.css(l);var m=O.outerHeight();var i=Ad/m;if(i<0.99){
                var H=O.parent();H.append(A("<div></div>").attr({
                    className:"jScrollPaneTrack"
                }).css({
                    width:C.scrollbarWidth+"px"
                    }).append(A("<div></div>").attr({
                    className:"jScrollPaneDrag"
                }).css({
                    width:C.scrollbarWidth+"px"
                    }).append(A("<div></div>").attr({
                    className:"jScrollPaneDragTop"
                }).css({
                    width:C.scrollbarWidth+"px"
                    }),A("<div></div>").attr({
                    className:"jScrollPaneDragBottom"
                }).css({
                    width:C.scrollbarWidth+"px"
                    }))));var z=A(">.jScrollPaneTrack",H);var P=A(">.jScrollPaneTrack .jScrollPaneDrag",H);if(C.showArrows){
                    var g;var Ab;var S;var r;var j=function(){
                        if(r>4||r%4==0){
                            y(u+Ab*b)
                            }r++
                    };var K=function(p){
                        A("html").unbind("mouseup",K);g.removeClass("jScrollActiveArrowButton");clearInterval(S)
                        };var Z=function(){
                        A("html").bind("mouseup",K);g.addClass("jScrollActiveArrowButton");r=0;j();S=setInterval(j,100)
                        };H.append(A("<a></a>").attr({
                        href:"javascript:;",
                        className:"jScrollArrowUp"
                    }).css({
                        width:C.scrollbarWidth+"px"
                        }).html("Scroll up").bind("mousedown",function(){
                        g=A(this);Ab=-1;Z();this.blur();return false
                        }).bind("click",B),A("<a></a>").attr({
                        href:"javascript:;",
                        className:"jScrollArrowDown"
                    }).css({
                        width:C.scrollbarWidth+"px"
                        }).html("Scroll down").bind("mousedown",function(){
                        g=A(this);Ab=1;Z();this.blur();return false
                        }).bind("click",B));var Q=A(">.jScrollArrowUp",H);var J=A(">.jScrollArrowDown",H);if(C.arrowSize){
                        M=Ad-C.arrowSize-C.arrowSize;z.css({
                            height:M+"px",
                            top:C.arrowSize+"px"
                            })
                        }else{
                        var s=Q.height();C.arrowSize=s;M=Ad-s-J.height();z.css({
                            height:M+"px",
                            top:s+"px"
                            })
                        }
                    }var w=A(this).css({
                    position:"absolute",
                    overflow:"visible"
                });var D;var Y;var b;var u=0;var V=i*Ad/2;var a=function(Ae,Ag){
                    var Af=Ag=="X"?"Left":"Top";return Ae["page"+Ag]||(Ae["client"+Ag]+(document.documentElement["scroll"+Af]||document.body["scroll"+Af]))||0
                    };var f=function(){
                    return false
                    };var v=function(){
                    n();D=P.offset(false);D.top-=u;Y=M-P[0].offsetHeight;b=2*C.wheelSpeed*Y/m
                    };var E=function(p){
                    v();V=a(p,"Y")-u-D.top;A("html").bind("mouseup",T).bind("mousemove",h);if(A.browser.msie){
                        A("html").bind("dragstart",f).bind("selectstart",f)
                        }return false
                    };var T=function(){
                    A("html").unbind("mouseup",T).unbind("mousemove",h);V=i*Ad/2;if(A.browser.msie){
                        A("html").unbind("dragstart",f).unbind("selectstart",f)
                        }
                    };var y=function(Ae){
                    Ae=Ae<0?0:(Ae>Y?Y:Ae);u=Ae;P.css({
                        top:Ae+"px"
                        });var Af=Ae/Y;w.css({
                        top:((Ad-m)*Af)+"px"
                        });O.trigger("scroll");if(C.showArrows){
                        Q[Ae==0?"addClass":"removeClass"]("disabled");J[Ae==Y?"addClass":"removeClass"]("disabled")
                        }
                    };var h=function(p){
                    y(a(p,"Y")-D.top-V)
                    };var q=Math.max(Math.min(i*(Ad-C.arrowSize*2),C.dragMaxHeight),C.dragMinHeight);P.css({
/*--------------Edit height------------------------*/
                    height:"49px"
                }).bind("mousedown",E);var k;var R;var I;var t=function(){
                    if(R>8||R%4==0){
                        y((u-((u-I)/2)))
                        }R++
                };var Aa=function(){
                    clearInterval(k);A("html").unbind("mouseup",Aa).unbind("mousemove",e)
                    };var e=function(p){
                    I=a(p,"Y")-D.top-V
                    };var U=function(p){
                    v();e(p);R=0;A("html").bind("mouseup",Aa).bind("mousemove",e);k=setInterval(t,100);t()
                    };z.bind("mousedown",U);H.bind("mousewheel",function(Ae,Ag){
                    v();n();var Af=u;y(u-Ag*b);var p=Af!=u;return !p
                    });var F;var W;function c(){
                    var p=(F-u)/C.animateStep;if(p>1||p<-1){
                        y(u+p)
                        }else{
                        y(F);n()
                        }
                    }var n=function(){
                    if(W){
                        clearInterval(W);delete F
                        }
                    };var x=function(Af,p){
                    if(typeof Af=="string"){
                        $e=A(Af,O);if(!$e.length){
                            return
                        }Af=$e.offset().top-O.offset().top
                        }H.scrollTop(0);n();var Ae=-Af/(Ad-m)*Y;if(p||!C.animateTo){
                        y(Ae)
                        }else{
                        F=Ae;W=setInterval(c,C.animateInterval)
                        }
                    };O[0].scrollTo=x;O[0].scrollBy=function(Ae){
                    var p=-parseInt(w.css("top"))||0;x(p+Ae)
                    };v();x(-Ac,true);A("*",this).bind("focus",function(Ah){
                    var Ag=A(this);var Aj=0;while(Ag[0]!=O[0]){
                        Aj+=Ag.position().top;Ag=Ag.offsetParent()
                        }var p=-parseInt(w.css("top"))||0;var Ai=p+Ad;var Af=Aj>p&&Aj<Ai;if(!Af){
                        var Ae=Aj-C.scrollbarMargin;if(Aj>p){
                            Ae+=A(this).height()+15+C.scrollbarMargin-Ad
                            }x(Ae)
                        }
                    });if(location.hash){
                    x(location.hash)
                    }A(document).bind("click",function(Ae){
                    $target=A(Ae.target);if($target.is("a")){
                        var p=$target.attr("href");if(p.substr(0,1)=="#"){
                            x(p)
                            }
                        }
                    });A.jScrollPane.active.push(O[0])
                }else{
                O.css({
                    height:Ad+"px",
                    width:d-this.originalSidePaddingTotal+"px",
                    padding:this.originalPadding
                    });O.parent().unbind("mousewheel")
                }
            })
        };A.fn.jScrollPane.defaults={
        scrollbarWidth:50,
        scrollbarMargin:5,
        wheelSpeed:18,
        showArrows:false,
        arrowSize:0,
        animateTo:false,
        dragMinHeight:1,
        dragMaxHeight:99999,
        animateInterval:100,
        animateStep:3,
        maintainPosition:true,
        scrollbarOnLeft:false,
        reinitialiseOnImageLoad:false
    };A(window).bind("unload",function(){
        var C=A.jScrollPane.active;for(var B=0;B<C.length;B++){
            C[B].scrollTo=C[B].scrollBy=null
            }
        })
    })(jQuery);