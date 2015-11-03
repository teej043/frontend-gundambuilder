(function(factory){var
amd=typeof define=='function'&&define.amd&&(define(['jquery'],factory)||true),commonjs=!amd&&typeof module=='object'&&typeof module.exports=='object'&&(module.exports=factory),plain=!amd&&!commonjs&&factory()})(function(){return jQuery.reel||(function($,window,document,undefined){if(!$)return;var
version=$&&$().jquery.split(/\./)
if(!version||+(twochar(version[0])+twochar(version[1])+twochar(version[2]||''))<10602)
return error('Too old jQuery library. Please upgrade your jQuery to version 1.6.2 or higher');var
reel=$.reel={version:'1.3.0',def:{frame:1,frames:36,loops:true,clickfree:false,draggable:true,scrollable:true,steppable:true,throwable:true,wheelable:true,orientable:false,cw:false,revolution:undefined,stitched:0,directional:false,row:1,rows:0,rowlock:false,framelock:false,orbital:0,vertical:false,inversed:false,footage:6,spacing:0,horizontal:true,suffix:'-reel',image:undefined,images:'',path:'',preload:'fidelity',shy:false,speed:0,delay:0,timeout:2,duration:undefined,rebound:0.5,entry:undefined,opening:0,brake:0.23,velocity:0,tempo:36,laziness:6,cursor:undefined,hint:'',indicator:0,klass:'',preloader:2,area:undefined,attr:{},annotations:undefined,responsive:false,graph:undefined,monitor:undefined},scan:function(){return $(dot(klass)+':not('+dot(overlay_klass)+' > '+dot(klass)+')').each(function(ix,image){var
$image=$(image),options=$image.data(),images=options.images=soft_array(options.images),annotations={}
$(dot(annotation_klass)+'[data-for='+$image.attr(_id_)+']').each(function(ix,annotation){var
$annotation=$(annotation),def=$annotation.data(),x=def.x=numerize_array(soft_array(def.x)),y=def.y=numerize_array(soft_array(def.y)),id=$annotation.attr(_id_),node=def.node=$annotation.removeData()
annotations[id]=def;});options.annotations=annotations;$image.removeData().reel(options);});},fn:{reel:function(){var
args=arguments,t=$(this),data=t.data(),name=args[0]||{},value=args[1]
if(typeof name!='object'){if(name.slice(0,1)==':'){return t.trigger(name.slice(1),value);}
else{if(args.length==1){return data[name]}
else{if(value!==undefined){reel.normal[name]&&(value=reel.normal[name](value,data));if(data[name]===undefined)data[name]=value
else if(data[name]!==value)t.trigger(name+'Change',[undefined,data[name]=value]);}
return t}}}
else{var
opt=$.extend({},reel.def,name),applicable=t.filter(_img_).unreel().filter(function(){var
$this=$(this),attr=opt.attr,src=attr.src||$this.attr(_src_),width=attr.width||$this.attr(_height_)||$this.width(),height=attr.height||$this.attr(_width_)||$this.height()
if(!src)return error('`src` attribute missing on target image');if(!width||!height)return error('Dimension(s) of the target image unknown');return true;}),instances=[]
applicable.each(function(){var
t=$(this),set=function(name,value){return t.reel(name,value)&&get(name)},get=function(name){return t.data(name)},on={setup:function(e){if(t.hasClass(klass)&&t.parent().hasClass(overlay_klass))return;set(_options_,opt);var
attr={src:t.attr(_src_),width:t.attr(_width_)||null,height:t.attr(_height_)||null,style:t.attr(_style_)||null,'class':t.attr(_class_)||null},src=t.attr(opt.attr).attr(_src_),id=set(_id_,t.attr(_id_)||t.attr(_id_,klass+'-'+(+new Date())).attr(_id_)),data=$.extend({},t.data()),images=set(_images_,opt.images||[]),stitched=set(_stitched_,opt.stitched),is_sprite=!images.length||stitched,responsive=set(_responsive_,opt.responsive&&(knows_background_size?true:!is_sprite)),truescale=set(_truescale_,{}),loops=opt.loops,orbital=opt.orbital,revolution=opt.revolution,rows=opt.rows,footage=set(_footage_,min(opt.footage,opt.frames)),spacing=set(_spacing_,opt.spacing),width=set(_width_,+t.attr(_width_)||t.width()),height=set(_height_,+t.attr(_height_)||t.height()),shy=set(_shy_,opt.shy),frames=set(_frames_,orbital&&footage||rows<=1&&images.length||opt.frames),multirow=rows>1||orbital,revolution_x=set(_revolution_,axis('x',revolution)||stitched/2||width*2),revolution_y=set(_revolution_y_,!multirow?0:(axis('y',revolution)||(rows>3?height:height/(5-rows)))),rows=stitched?1:ceil(frames/footage),stitched_travel=set(_stitched_travel_,stitched-(loops?0:width)),stitched_shift=set(_stitched_shift_,0),stage_id=hash(id+opt.suffix),img_class=t.attr(_class_),classes=!img_class?__:img_class+___,$overlay=$(tag(_div_),{id:stage_id.substr(1),'class':classes+___+overlay_klass+___+frame_klass+'0'}),$instance=t.wrap($overlay.addClass(opt.klass)).addClass(klass),instances_count=instances.push(add_instance($instance)[0]),$overlay=$instance.parent().bind(on.instance)
set(_image_,images.length?__:opt.image||src.replace(reel.re.image,'$1'+opt.suffix+'.$2'));set(_cache_,$(tag(_div_),{'class':cache_klass}).appendTo('body'));set(_area_,$()),set(_cached_,[]);set(_frame_,null);set(_fraction_,null);set(_row_,opt.row);set(_tier_,0);set(_rows_,rows);set(_rowlock_,opt.rowlock);set(_framelock_,opt.framelock);set(_departure_,set(_destination_,set(_distance_,0)));set(_bit_,1/frames);set(_stage_,stage_id);set(_backwards_,set(_speed_,opt.speed)<0);set(_loading_,false);set(_velocity_,0);set(_vertical_,opt.vertical);set(_preloaded_,0);set(_cwish_,negative_when(1,!opt.cw&&!stitched));set(_clicked_location_,{});set(_clicked_,false);set(_clicked_on_,set(_clicked_tier_,0));set(_lo_,set(_hi_,0));set(_reeling_,false);set(_reeled_,false);set(_opening_,false);set(_brake_,opt.brake);set(_center_,!!orbital);set(_tempo_,opt.tempo/(reel.lazy?opt.laziness:1));set(_opening_ticks_,-1);set(_ticks_,-1);set(_annotations_,opt.annotations||$overlay.unbind(dot(_annotations_))&&{});set(_ratio_,1);set(_backup_,{attr:attr,data:data});opt.steppable||$overlay.unbind('up.steppable');opt.indicator||$overlay.unbind('.indicator');css(__,{overflow:_hidden_,position:'relative'});responsive||css(__,{width:width,height:height});responsive&&$.each(responsive_keys,function(i,key){truescale[key]=get(key)});css(____+___+dot(klass),{display:_block_});css(dot(cache_klass),{position:'fixed',left:px(-100),top:px(-100)},true);css(dot(cache_klass)+___+_img_,{position:_absolute_,width:10,height:10},true);pool.bind(on.pool);t.trigger(shy?'prepare':'setup')},instance:{teardown:function(e){var
backup=t.data(_backup_)
t.parent().unbind(on.instance);if(get(_shy_))t.parent().unbind(_click_,shy_setup)
else get(_style_).remove()&&get(_area_).unbind(ns);get(_cache_).empty();clearTimeout(delay);clearTimeout(gauge_delay);$(window).unbind(_resize_,slow_gauge);$(window).unbind(ns);pool.unbind(on.pool);pools.unbind(pns);t.siblings().unbind(ns).remove();no_bias();t.removeAttr('onloaded');remove_instance(t.unbind(ns).removeData().unwrap().attr(backup.attr).data(backup.data));t.attr(_style_)==__&&t.removeAttr(_style_);},setup:function(e){var
$overlay=t.parent().append(preloader()),$area=set(_area_,$(opt.area||$overlay)),multirow=opt.rows>1,cursor=opt.cursor,cursor_up=cursor==_hand_?drag_cursor:cursor||reel_cursor,cursor_down=cursor==_hand_?drag_cursor_down+___+'!important':undefined
css(___+dot(klass),{MozUserSelect:_none_,WebkitUserSelect:_none_,MozTransform:'translateZ(0)'});t.unbind(_click_,shy_setup);$area.bind(_touchstart_,press).bind(opt.clickfree?_mouseenter_:_mousedown_,press).bind(opt.wheelable?_mousewheel_:null,wheel).bind(_dragstart_,function(){return false})
css(__,{cursor:cdn(cursor_up)});css(dot(loading_klass),{cursor:'wait'});css(dot(panning_klass)+____+dot(panning_klass)+' *',{cursor:cdn(cursor_down||cursor_up)},true);if(get(_responsive_)){css(___+dot(klass),{width:'100%',height:_auto_});$(window).bind(_resize_,slow_gauge);}
function press(e){return t.trigger('down',[pointer(e).clientX,pointer(e).clientY,e])&&e.give}
function wheel(e,delta){return!delta||t.trigger('wheel',[delta,e])&&e.give}
opt.hint&&$area.attr('title',opt.hint);opt.indicator&&$overlay.append(indicator('x'));multirow&&opt.indicator&&$overlay.append(indicator('y'));opt.monitor&&$overlay.append($monitor=$(tag(_div_),{'class':monitor_klass}))&&css(___+dot(monitor_klass),{position:_absolute_,left:0,top:0});},preload:function(e){var
$overlay=t.parent(),images=get(_images_),is_sprite=!images.length,order=reel.preload[opt.preload]||reel.preload[reel.def.preload],preload=is_sprite?[get(_image_)]:order(images.slice(0),opt,get),to_load=preload.length,preloaded=set(_preloaded_,is_sprite?0.5:0),simultaneous=0,$cache=get(_cache_).empty(),uris=[]
$overlay.addClass(loading_klass);set(_style_,get(_style_)||$('<'+_style_+' type="text/css">'+css.rules.join('\n')+'</'+_style_+'>').prependTo(_head_));set(_loading_,true);t.trigger('stop');opt.responsive&&gauge();t.trigger('resize',true);while(preload.length){var
uri=reel.substitute(opt.path+preload.shift(),get),$img=$(tag(_img_)).data(_src_,uri).appendTo($cache)
$img.bind('load error abort',function(e){e.type!='load'&&t.trigger(e.type);return!detached($overlay)&&t.trigger('preloaded')&&load()&&false;});uris.push(uri);}
setTimeout(function(){while(++simultaneous<reel.concurrent_requests)load();},0);set(_cached_,uris);set(_shy_,false);function load(){var
$img=$cache.children(':not([src]):first')
return $img.attr(_src_,$img.data(_src_))}},preloaded:function(e){var
images=get(_images_).length||1,preloaded=set(_preloaded_,min(get(_preloaded_)+1,images))
if(preloaded===1)var
frame=t.trigger('frameChange',[undefined,get(_frame_)])
if(preloaded===images){t.parent().removeClass(loading_klass);t.trigger('loaded');}},loaded:function(e){get(_images_).length>1||t.css({backgroundImage:url(reel.substitute(opt.path+get(_image_),get))}).attr({src:cdn(transparent)});get(_stitched_)&&t.attr({src:cdn(transparent)});get(_reeled_)||set(_velocity_,opt.velocity||0);set(_loading_,false);loaded=true;},prepare:function(e){t.css('display',_block_).parent().one(_click_,shy_setup);},opening:function(e){if(!opt.opening)return t.trigger('openingDone');var
opening=set(_opening_,true),stopped=set(_stopped_,!get(_speed_)),speed=opt.entry||opt.speed,end=get(_fraction_),duration=opt.opening,start=set(_fraction_,end-speed*duration),ticks=set(_opening_ticks_,ceil(duration*leader(_tempo_)))},openingDone:function(e){var
playing=set(_playing_,false),opening=set(_opening_,false),evnt=_tick_+dot(_opening_)
pool.unbind(evnt,on.pool[evnt]);opt.orientable&&$(window).bind(_deviceorientation_,orient);if(opt.delay>0)delay=setTimeout(function(){t.trigger('play')},opt.delay*1000)
else t.trigger('play');function orient(e){return t.trigger('orient',[gyro(e).alpha,gyro(e).beta,gyro(e).gamma,e])&&e.give}},play:function(e,speed){var
speed=speed?set(_speed_,speed):(get(_speed_)*negative_when(1,get(_backwards_))),duration=opt.duration,ticks=duration&&set(_ticks_,ceil(duration*leader(_tempo_))),backwards=set(_backwards_,speed<0),playing=set(_playing_,!!speed),stopped=set(_stopped_,!playing)
idle();},reach:function(e,target,speed){if(target==get(_frame_))return;var
frames=get(_frames_),row=set(_row_,ceil(target/frames)),departure=set(_departure_,get(_frame_)),target=set(_destination_,target),shortest=set(_distance_,reel.math.distance(departure,target,frames)),speed=abs(speed||get(_speed_))*negative_when(1,shortest<0)
t.trigger('play',speed);},pause:function(e){unidle();},stop:function(e){var
stopped=set(_stopped_,true),playing=set(_playing_,!stopped)},down:function(e,x,y,ev){if(!opt.clickfree&&ev&&ev.button!==undefined&&ev.button!=DRAG_BUTTON)return;if(opt.draggable){var
clicked=set(_clicked_,get(_frame_)),clickfree=opt.clickfree,velocity=set(_velocity_,0),$area=clickfree?get(_area_):pools,origin=last=recenter_mouse(get(_revolution_),x,y)
unidle();no_bias();panned=0;$(_html_,pools).addClass(panning_klass);$area.bind(_touchmove_+___+_mousemove_,drag).bind(_touchend_+___+_touchcancel_,lift).bind(clickfree?_mouseleave_:_mouseup_,lift)}
function drag(e){return t.trigger('pan',[pointer(e).clientX,pointer(e).clientY,e])&&e.give}
function lift(e){return t.trigger('up',[e])&&e.give}},up:function(e,ev){var
clicked=set(_clicked_,false),reeling=set(_reeling_,false),throwable=opt.throwable,biases=abs(bias[0]+bias[1])/60,velocity=set(_velocity_,!throwable?0:throwable===true?biases:min(throwable,biases)),brakes=braking=velocity?1:0
unidle();no_bias();$(_html_,pools).removeClass(panning_klass);(opt.clickfree?get(_area_):pools).unbind(pns);},pan:function(e,x,y,ev){if(opt.draggable&&slidable){slidable=false;unidle();var
rows=opt.rows,orbital=opt.orbital,scrollable=!get(_reeling_)&&rows<=1&&!orbital&&opt.scrollable,delta={x:x-last.x,y:y-last.y},abs_delta={x:abs(delta.x),y:abs(delta.y)}
if(ev&&scrollable&&abs_delta.x<abs_delta.y)return ev.give=true;if(abs_delta.x>0||abs_delta.y>0){ev&&(ev.give=false);panned=max(abs_delta.x,abs_delta.y);last={x:x,y:y};var
revolution=get(_revolution_),origin=get(_clicked_location_),vertical=get(_vertical_)
if(!get(_framelock_))var
fraction=set(_fraction_,graph(vertical?y-origin.y:x-origin.x,get(_clicked_on_),revolution,get(_lo_),get(_hi_),get(_cwish_),vertical?y-origin.y:x-origin.x)),reeling=set(_reeling_,get(_reeling_)||get(_frame_)!=get(_clicked_)),motion=to_bias(vertical?delta.y:delta.x||0),backwards=motion&&set(_backwards_,motion<0)
if(orbital&&get(_center_))var
vertical=set(_vertical_,abs(y-origin.y)>abs(x-origin.x)),origin=recenter_mouse(revolution,x,y)
if(rows>1&&!get(_rowlock_))var
revolution_y=get(_revolution_y_),start=get(_clicked_tier_),lo=-start*revolution_y,tier=set(_tier_,reel.math.envelope(y-origin.y,start,revolution_y,lo,lo+revolution_y,-1))
if(!(fraction%1)&&!opt.loops)var
origin=recenter_mouse(revolution,x,y)}}},wheel:function(e,distance,ev){if(!distance)return;wheeled=true;var
delta=ceil(math.sqrt(abs(distance))/2),delta=negative_when(delta,distance>0),revolution=0.0833*get(_revolution_),origin=recenter_mouse(revolution),backwards=delta&&set(_backwards_,delta<0),velocity=set(_velocity_,0),fraction=set(_fraction_,graph(delta,get(_clicked_on_),revolution,get(_lo_),get(_hi_),get(_cwish_)))
ev&&ev.preventDefault();ev&&(ev.give=false);unidle();t.trigger('up',[ev]);},orient:function(e,alpha,beta,gamma,ev){if(!slidable||operated)return;oriented=true;var
alpha_fraction=alpha/360
fraction=set(_fraction_,+((opt.stitched||opt.cw?1-alpha_fraction:alpha_fraction)).toFixed(2))
slidable=false;},fractionChange:function(e,nil,fraction){if(nil!==undefined)return;var
frame=1+floor(fraction/get(_bit_)),multirow=opt.rows>1,orbital=opt.orbital,center=set(_center_,!!orbital&&(frame<=orbital||frame>=get(_footage_)-orbital+2))
if(multirow)var
frame=frame+(get(_row_)-1)*get(_frames_)
var
frame=set(_frame_,frame)},tierChange:function(e,nil,tier){if(nil===undefined)var
row=set(_row_,round(interpolate(tier,1,opt.rows))),frames=get(_frames_),frame=get(_frame_)%frames||frames,frame=set(_frame_,frame+row*frames-frames)},rowChange:function(e,nil,row){if(nil===undefined)var
tier=may_set(_tier_,undefined,row,opt.rows)},frameChange:function(e,nil,frame){if(nil!==undefined)return;this.className=this.className.replace(reel.re.frame_klass,frame_klass+frame);var
frames=get(_frames_),rows=opt.rows,path=opt.path,base=frame%frames||frames,frame_row=(frame-base)/frames+1,frame_tier=(frame_row-1)/(rows-1),row=get(_row_),tier=!rows?get(_tier_):may_set(_tier_,frame_tier,row,rows),fraction=may_set(_fraction_,undefined,base,frames),footage=get(_footage_)
if(opt.orbital&&get(_vertical_))var
frame=opt.inversed?footage+1-frame:frame,frame=frame+footage
var
stitched=get(_stitched_),images=get(_images_),is_sprite=!images.length||stitched
if(!is_sprite){get(_responsive_)&&gauge();get(_preloaded_)&&t.attr({src:reen(reel.substitute(path+images[frame-1],get))});}else{var
spacing=get(_spacing_),width=get(_width_),height=get(_height_)
if(!stitched)var
horizontal=opt.horizontal,minor=(frame%footage)-1,minor=minor<0?footage-1:minor,major=floor((frame-0.1)/footage),major=major+(rows>1?0:(get(_backwards_)?0:!opt.directional?0:get(_rows_))),a=major*((horizontal?height:width)+spacing),b=minor*((horizontal?width:height)+spacing),shift=images.length?[0,0]:horizontal?[px(-b),px(-a)]:[px(-a),px(-b)]
else{var
x=set(_stitched_shift_,round(interpolate(fraction,0,get(_stitched_travel_)))%stitched),y=rows<=1?0:(height+spacing)*(rows-row),shift=[px(-x),px(-y)],image=images.length>1&&images[row-1],fullpath=reel.substitute(path+image,get)
image&&t.css('backgroundImage').search(fullpath)<0&&t.css({backgroundImage:url(fullpath)})}
t.css({backgroundPosition:shift.join(___)})}},'frameChange.reach':function(e,nil,frame){if(!get(_destination_)||nil!==undefined)return;var
travelled=reel.math.distance(get(_departure_),frame,get(_frames_)),onorover=abs(travelled)>=abs(get(_distance_))
if(!onorover)return;set(_frame_,set(_destination_));set(_destination_,set(_distance_,set(_departure_,0)));t.trigger('stop');},'imageChange imagesChange':function(e,nil,image){t.trigger('preload');},'fractionChange.indicator':function(e,nil,fraction){if(opt.indicator&&nil===undefined)var
size=opt.indicator,orbital=opt.orbital,travel=orbital&&get(_vertical_)?get(_height_):get(_width_),slots=orbital?get(_footage_):opt.images.length||get(_frames_),weight=ceil(travel/slots),travel=travel-weight,indicate=round(interpolate(fraction,0,travel)),indicate=!opt.cw||get(_stitched_)?indicate:travel-indicate,$indicator=indicator.$x.css(get(_vertical_)?{left:0,top:px(indicate),bottom:_auto_,width:size,height:weight}:{bottom:0,left:px(indicate),top:_auto_,width:weight,height:size})},'tierChange.indicator':function(e,nil,tier){if(opt.rows>1&&opt.indicator&&nil===undefined)var
travel=get(_height_),size=opt.indicator,weight=ceil(travel/opt.rows),travel=travel-weight,indicate=round(tier*travel),$yindicator=indicator.$y.css({left:0,top:indicate,width:size,height:weight})},'setup.annotations':function(e){var
$overlay=t.parent()
$.each(get(_annotations_),function(ida,note){var
$note=typeof note.node==_string_?$(note.node):note.node||{},$note=$note.jquery?$note:$(tag(_div_),$note),$note=$note.attr({id:ida}).addClass(annotation_klass),$image=note.image?$(tag(_img_),note.image):$(),$link=note.link?$(tag('a'),note.link).click(function(){t.trigger('up.annotations',{target:$link});}):$()
css(hash(ida),{display:_none_,position:_absolute_},true);note.image||note.link&&$note.append($link);note.link||note.image&&$note.append($image);note.link&&note.image&&$note.append($link.append($image));$note.appendTo($overlay);});},'prepare.annotations':function(e){$.each(get(_annotations_),function(ida,note){$(hash(ida)).hide();});},'frameChange.annotations':function(e,nil,frame){if(!get(_preloaded_)||nil!==undefined)return;var
width=get(_width_),stitched=get(_stitched_),ss=get(_stitched_shift_)
$.each(get(_annotations_),function(ida,note){var
$note=$(hash(ida)),start=note.start||1,end=note.end,frame=frame||get(_frame_),offset=frame-1,at=note.at?(note.at[offset]=='+'):false,offset=note.at?offset:offset-start+1,x=typeof note.x!=_object_?note.x:note.x[offset],y=typeof note.y!=_object_?note.y:note.y[offset],placed=x!==undefined&&y!==undefined,visible=placed&&(note.at?at:(offset>=0&&(!end||offset<=end-start)))
if(stitched)var
on_edge=x<width&&ss>stitched-width,after_edge=x>stitched-width&&ss>=0&&ss<width,x=!on_edge?x:x+stitched,x=!after_edge?x:x-stitched,x=x-ss
if(get(_responsive_))var
ratio=get(_ratio_),x=x&&x*ratio,y=y&&y*ratio
var
style={display:visible?_block_:_none_,left:px(x),top:px(y)}
$note.css(style);});},'up.annotations':function(e,ev){if(panned>10||wheeled)return;var
$target=$(ev.target),$link=($target.is('a')?$target:$target.parents('a')),href=$link.attr('href')
href&&(panned=10);},'up.steppable':function(e,ev){if(panned||wheeled)return;t.trigger(get(_clicked_location_).x-t.offset().left>0.5*get(_width_)?'stepRight':'stepLeft')},'stepLeft stepRight':function(e){unidle();},stepLeft:function(e){set(_backwards_,false);set(_fraction_,get(_fraction_)-get(_bit_)*get(_cwish_));},stepRight:function(e){set(_backwards_,true);set(_fraction_,get(_fraction_)+get(_bit_)*get(_cwish_));},stepUp:function(e){set(_row_,get(_row_)-1);},stepDown:function(e){set(_row_,get(_row_)+1);},resize:function(e,force){if(get(_loading_)&&!force)return;var
stitched=get(_stitched_),spacing=get(_spacing_),height=get(_height_),is_sprite=!get(_images_).length||stitched,rows=opt.rows||1,size=get(_images_).length?!stitched?undefined:px(stitched)+___+px(height):stitched&&px(stitched)+___+px((height+spacing)*rows-spacing)||px((get(_width_)+spacing)*get(_footage_)-spacing)+___+px((height+spacing)*get(_rows_)*rows*(opt.directional?2:1)-spacing)
t.css({height:is_sprite?px(height):null,backgroundSize:size||null});force||t.trigger('imagesChange');},'setup.fu':function(e){var
frame=set(_frame_,opt.frame+(get(_row_)-1)*get(_frames_))
t.trigger('preload')},'wheel.fu':function(){wheeled=false},'clean.fu':function(){t.trigger('teardown')},'loaded.fu':function(){t.trigger('opening')}},pool:{'tick.reel.preload':function(e){if(!(loaded||get(_loading_))||get(_shy_))return;var
width=get(_width_),current=number(preloader.$.css(_width_)),images=get(_images_).length||1,target=round(1/images*get(_preloaded_)*width)
preloader.$.css({width:current+(target-current)/3+1})
if(get(_preloaded_)===images&&current>width-1){loaded=false;preloader.$.fadeOut(300,function(){preloader.$.css({opacity:1,width:0})});}},'tick.reel':function(e){if(get(_shy_))return;var
velocity=get(_velocity_),leader_tempo=leader(_tempo_),monitor=opt.monitor
if(!reel.intense&&offscreen())return;if(braking)var
braked=velocity-(get(_brake_)/leader_tempo*braking),velocity=set(_velocity_,braked>0.1?braked:(braking=operated=0))
monitor&&$monitor.text(get(monitor));velocity&&braking++;operated&&operated++;to_bias(0);slidable=true;if(operated&&!velocity)return mute(e);if(get(_clicked_))return mute(e,unidle());if(get(_opening_ticks_)>0)return;if(!opt.loops&&opt.rebound)var
edgy=!operated&&!(get(_fraction_)%1)?on_edge++:(on_edge=0),bounce=on_edge>=opt.rebound*1000/leader_tempo,backwards=bounce&&set(_backwards_,!get(_backwards_))
var
direction=get(_cwish_)*negative_when(1,get(_backwards_)),ticks=get(_ticks_),step=(!get(_playing_)||oriented||!ticks?velocity:abs(get(_speed_))+velocity)/leader(_tempo_),fraction=set(_fraction_,get(_fraction_)-step*direction),ticks=!opt.duration?ticks:ticks>0&&set(_ticks_,ticks-1)
!ticks&&get(_playing_)&&t.trigger('stop');},'tick.reel.opening':function(e){if(!get(_opening_))return;var
speed=opt.entry||opt.speed,step=speed/leader(_tempo_)*(opt.cw?-1:1),ticks=set(_opening_ticks_,get(_opening_ticks_)-1),fraction=set(_fraction_,get(_fraction_)+step)
ticks||t.trigger('openingDone');}}},loaded=false,mute=function(e,result){return e.stopImmediatePropagation()||result},shy_setup=function(){t.trigger('setup')},operated,braking=0,idle=function(){return operated=0},unidle=function(){clearTimeout(delay);pool.unbind(_tick_+dot(_opening_),on.pool[_tick_+dot(_opening_)]);set(_opening_ticks_,0);set(_reeled_,true);return operated=-opt.timeout*leader(_tempo_)},panned=0,wheeled=false,oriented=false,$monitor=$(),preloader=function(){css(___+dot(preloader_klass),{position:_absolute_,left:0,bottom:0,height:opt.preloader,overflow:_hidden_,backgroundColor:'#000'});return preloader.$=$(tag(_div_),{'class':preloader_klass})},indicator=function(axis){css(___+dot(indicator_klass)+dot(axis),{position:_absolute_,width:0,height:0,overflow:_hidden_,backgroundColor:'#000'});return indicator['$'+axis]=$(tag(_div_),{'class':indicator_klass+___+axis})},css=function(selector,definition,global){var
stage=global?__:get(_stage_),selector=selector.replace(/^/,stage).replace(____,____+stage)
return css.rules.push(selector+cssize(definition))&&definition
function cssize(values){var rules=[];$.each(values,function(key,value){rules.push(key.replace(/([A-Z])/g,'-$1').toLowerCase()+':'+px(value)+';')});return'{'+rules.join(__)+'}'}},$style,offscreen=function(){var
height=get(_height_),width=get(_width_),rect=t[0].getBoundingClientRect()
return rect.top<-height||rect.left<-width||rect.right>width+$(window).width()||rect.bottom>height+$(window).height()},on_edge=0,last={x:0,y:0},to_bias=function(value){return bias.push(value)&&bias.shift()&&value},no_bias=function(){return bias=[0,0]},bias=no_bias(),graph=opt.graph||reel.math[opt.loops?'hatch':'envelope'],normal=reel.normal,slow_gauge=function(){clearTimeout(gauge_delay);gauge_delay=setTimeout(gauge,reel.resize_gauge);},gauge=function(){if(t.width()==get(_width_))return;var
truescale=get(_truescale_),ratio=set(_ratio_,t.width()/truescale.width)
$.each(truescale,function(key,value){set(key,round(value*ratio))})
t.trigger('resize');},delay,gauge_delay,recenter_mouse=function(revolution,x,y){var
fraction=set(_clicked_on_,get(_fraction_)),tier=set(_clicked_tier_,get(_tier_)),loops=opt.loops,lo=set(_lo_,loops?0:-fraction*revolution),hi=set(_hi_,loops?revolution:revolution-fraction*revolution)
return x!==undefined&&set(_clicked_location_,{x:x,y:y})||undefined},slidable=true,may_set=function(key,value,cousin,maximum){if(!maximum)return;var
current=get(key)||0,recalculated=value!==undefined?value:(cousin-1)/(maximum-1),recalculated=key!=_fraction_?recalculated:min(recalculated,0.9999),worthy=+abs(current-recalculated).toFixed(8)>=+(1/(maximum-1)).toFixed(8),value=worthy?set(key,recalculated):value||current
return value},pools=pool
try{if(pool[0]!=top.document)pools=pool.add(top.document)}
catch(e){}
var
$iframe=top===self?$():(function sense_iframe($ifr){$('iframe',pools.last()).each(function(){try{if($(this).contents().find(_head_).html()==$(_head_).html())return($ifr=$(this))&&false}
catch(e){}})
return $ifr})()
css.rules=[];on.setup();});ticker=ticker||(function tick(){var
start=+new Date(),tempo=leader(_tempo_)
if(!tempo)return ticker=null;pool.trigger(_tick_);reel.cost=(+new Date()+reel.cost-start)/2;return ticker=setTimeout(tick,max(4,1000/tempo-reel.cost));})();return $(instances);}},unreel:function(){return this.trigger('teardown');}},re:{image:/^(.*)\.(jpg|jpeg|png|gif)\??.*$/i,ua:[/(msie|opera|firefox|chrome|safari)[ \/:]([\d.]+)/i,/(webkit)\/([\d.]+)/i,/(mozilla)\/([\d.]+)/i],array:/ *, */,lazy_agent:/\(iphone|ipod|android|fennec|blackberry/i,frame_klass:/frame-\d+/,substitution:/(@([A-Z]))/g,no_match:/^(undefined|)$/,sequence:/(^[^#|]*([#]+)[^#|]*)($|[|]([0-9]+)\.\.([0-9]+))($|[|]([0-9]+)$)/},cdn:'http://code.vostrel.net/',math:{envelope:function(x,start,revolution,lo,hi,cwness,y){return start+min_max(lo,hi,-x*cwness)/revolution},hatch:function(x,start,revolution,lo,hi,cwness,y){var
x=(x<lo?hi:0)+x%hi,fraction=start+(-x*cwness)/revolution
return fraction-floor(fraction)},interpolate:function(fraction,lo,hi){return lo+fraction*(hi-lo)},distance:function(start,end,total){var
half=total/2,d=end-start
return d<-half?d+total:d>half?d-total:d}},preload:{fidelity:function(sequence,opt,get){var
orbital=opt.orbital,rows=orbital?2:opt.rows||1,frames=orbital?get(_footage_):get(_frames_),start=(opt.row-1)*frames,values=new Array().concat(sequence),present=new Array(sequence.length+1),priority=rows<2?[]:values.slice(start,start+frames)
return spread(priority,1,start).concat(spread(values,rows,0))
function spread(sequence,rows,offset){if(!sequence.length)return[];var
order=[],passes=4*rows,start=opt.frame,frames=sequence.length,plus=true,granule=frames/passes
for(var i=0;i<passes;i++)
add(start+round(i*granule));while(granule>1)
for(var i=0,length=order.length,granule=granule/2,p=plus=!plus;i<length;i++)
add(order[i]+(plus?1:-1)*round(granule));for(var i=0;i<=frames;i++)add(i);for(var i=0;i<order.length;i++)
order[i]=sequence[order[i]-1];return order
function add(frame){while(!(frame>=1&&frame<=frames))
frame+=frame<1?+frames:-frames;return present[offset+frame]||(present[offset+frame]=!!order.push(frame))}}},linear:function(sequence,opt,get){return sequence}},substitute:function(uri,get){return uri.replace(reel.re.substitution,function(match,mark,key){return typeof reel.substitutes[key]=='function'?reel.substitutes[key](get):substitution_keys[key]?get(substitution_keys[key]):mark;});},substitutes:{T:function(get){return+new Date()}},normal:{fraction:function(fraction,data){if(fraction===null)return fraction;return data[_options_].loops?fraction-floor(fraction):min_max(0,1,fraction)},tier:function(tier,data){if(tier===null)return tier;return min_max(0,1,tier)},row:function(row,data){if(row===null)return row;return round(min_max(1,data[_options_].rows,row))},frame:function(frame,data){if(frame===null)return frame;var
opt=data[_options_],frames=data[_frames_]*(opt.orbital?2:opt.rows||1),result=round(opt.loops?frame%frames||frames:min_max(1,frames,frame))
return result<0?result+frames:result},images:function(images,data){var
sequence=reel.re.sequence.exec(images),result=!sequence?images:reel.sequence(sequence,data[_options_])
return result;}},sequence:function(sequence,opt){if(sequence.length<=1)return opt.images;var
images=[],orbital=opt.orbital,url=sequence[1],placeholder=sequence[2],start=sequence[4],start=reel.re.no_match.test(start+__)?1:+start,rows=orbital?2:opt.rows||1,frames=orbital?opt.footage:opt.stitched?1:opt.frames,end=+(sequence[5]||rows*frames),total=end-start,increment=+sequence[7]||1,counter=0
while(counter<=total){images.push(url.replace(placeholder,pad((start+counter+__),placeholder.length,'0')));counter+=increment;}
return images;},instances:$(),leader:leader,resize_gauge:300,concurrent_requests:4,cost:0},pool=$(document),client=navigator.userAgent,browser=reel.re.ua[0].exec(client)||reel.re.ua[1].exec(client)||reel.re.ua[2].exec(client),browser_version=+browser[2].split('.').slice(0,2).join('.'),ie=browser[1]=='MSIE',knows_data_urls=!(ie&&browser_version<8),knows_background_size=!(ie&&browser_version<9),ticker,klass='reel',overlay_klass=klass+'-overlay',cache_klass=klass+'-cache',indicator_klass=klass+'-indicator',preloader_klass=klass+'-preloader',monitor_klass=klass+'-monitor',annotation_klass=klass+'-annotation',panning_klass=klass+'-panning',loading_klass=klass+'-loading',frame_klass='frame-',math=Math,round=math.round,floor=math.floor,ceil=math.ceil,min=math.min,max=math.max,abs=math.abs,number=parseInt,interpolate=reel.math.interpolate,_annotations_='annotations',_area_='area',_auto_='auto',_backup_='backup',_backwards_='backwards',_bit_='bit',_brake_='brake',_cache_='cache',_cached_=_cache_+'d',_center_='center',_class_='class',_click_='click',_clicked_=_click_+'ed',_clicked_location_=_clicked_+'_location',_clicked_on_=_clicked_+'_on',_clicked_tier_=_clicked_+'_tier',_cwish_='cwish',_departure_='departure',_destination_='destination',_distance_='distance',_footage_='footage',_fraction_='fraction',_frame_='frame',_framelock_='framelock',_frames_='frames',_height_='height',_hi_='hi',_hidden_='hidden',_image_='image',_images_='images',_lo_='lo',_loading_='loading',_mouse_='mouse',_opening_='opening',_opening_ticks_=_opening_+'_ticks',_options_='options',_playing_='playing',_preloaded_='preloaded',_ratio_='ratio',_reeling_='reeling',_reeled_='reeled',_responsive_='responsive',_revolution_='revolution',_revolution_y_='revolution_y',_row_='row',_rowlock_='rowlock',_rows_='rows',_shy_='shy',_spacing_='spacing',_speed_='speed',_src_='src',_stage_='stage',_stitched_='stitched',_stitched_shift_=_stitched_+'_shift',_stitched_travel_=_stitched_+'_travel',_stopped_='stopped',_style_='style',_tempo_='tempo',_ticks_='ticks',_tier_='tier',_touch_='touch',_truescale_='truescale',_velocity_='velocity',_vertical_='vertical',_width_='width',ns=dot(klass),pns=dot('pan')+ns,_deviceorientation_='deviceorientation'+ns,_dragstart_='dragstart'+ns,_mousedown_=_mouse_+'down'+ns,_mouseenter_=_mouse_+'enter'+ns,_mouseleave_=_mouse_+'leave'+pns,_mousemove_=_mouse_+'move'+pns,_mouseup_=_mouse_+'up'+pns,_mousewheel_=_mouse_+'wheel'+ns,_tick_='tick'+ns,_touchcancel_=_touch_+'cancel'+pns,_touchend_=_touch_+'end'+pns,_touchstart_=_touch_+'start'+ns,_touchmove_=_touch_+'move'+pns,_resize_='resize'+ns,__='',___=' ',____=',',_absolute_='absolute',_block_='block',_cdn_='@CDN@',_div_='div',_hand_='hand',_head_='head',_html_='html',_id_='id',_img_='img',_jquery_reel_='jquery.'+klass,_move_='move',_none_='none',_object_='object',_preload_='preload',_string_='string',responsive_keys=[_width_,_height_,_spacing_,_revolution_,_revolution_y_,_stitched_,_stitched_shift_,_stitched_travel_],substitution_keys={W:_width_,H:_height_},transparent=knows_data_urls?embedded('CAAIAIAAAAAAAAAAACH5BAEAAAAALAAAAAAIAAgAAAIHhI+py+1dAAA7'):_cdn_+'blank.gif',reel_cursor=url(_cdn_+_jquery_reel_+'.cur')+____+_move_,drag_cursor=url(_cdn_+_jquery_reel_+'-drag.cur')+____+_move_,drag_cursor_down=url(_cdn_+_jquery_reel_+'-drag-down.cur')+____+_move_,lazy=reel.lazy=(reel.re.lazy_agent).test(client),DRAG_BUTTON=ie&&browser_version<9?1:0,cleanData=$.cleanData,cleanDataEvent=$.cleanData=function(elements){$(elements).each(function(){$(this).triggerHandler('clean');});return cleanData.apply(this,arguments);}
$.extend($.fn,reel.fn)&&$(reel.scan);return reel;function add_instance($instance){return(reel.instances.push($instance[0]))&&$instance}
function remove_instance($instance){return(reel.instances=reel.instances.not(hash($instance.attr(_id_))))&&$instance}
function leader(key){return reel.instances.first().data(key)}
function embedded(image){return'data:image/gif;base64,R0lGODlh'+image}
function tag(string){return'<'+string+'/>'}
function dot(string){return'.'+(string||'')}
function cdn(path){return path.replace(_cdn_,reel.cdn)}
function url(location){return'url(\''+reen(location)+'\')'}
function axis(key,value){return typeof value==_object_?value[key]:value}
function min_max(minimum,maximum,number){return max(minimum,min(maximum,number))}
function negative_when(value,condition){return abs(value)*(condition?-1:1)}
function pointer(e){return e.touch||e.originalEvent.touches&&e.originalEvent.touches[0]||e}
function gyro(e){return e.originalEvent}
function px(value){return value===undefined?0:typeof value==_string_?value:value+'px'}
function hash(value){return'#'+value}
function pad(string,len,fill){while(string.length<len)string=fill+string;return string}
function twochar(string){return pad(string,2,'0')}
function reen(uri){return encodeURI(decodeURI(uri))}
function soft_array(string){return reel.re.array.exec(string)?string.split(reel.re.array):string}
function detached($node){return!$node.parents(_html_).length}
function numerize_array(array){return typeof array==_string_?array:$.each(array,function(ix,it){array[ix]=it?+it:undefined})}
function error(message){try{console.error('[ Reel ] '+message)}catch(e){}}})(jQuery,window,document);});