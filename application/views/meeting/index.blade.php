@layout('dev-master')
@section('page_content')
{{render_each('meeting.partial-index-item', $meetings->results, 'meeting')}}
@endsection