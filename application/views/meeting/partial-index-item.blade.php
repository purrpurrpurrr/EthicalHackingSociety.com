<h1>{{$meeting->title}}</h1>
<h6>{{$meeting->f_when}}
	//	Speakers:
@foreach($meeting->speakers as $speaker)
<em><a href="{{action('member@profile',array($speaker->id))}}">{{$speaker->name}}</a></em>
@endforeach
</h6>
{{Markitup::safe_nl2br($meeting->body)}}