<ul class="job-titles-list" id="job-titles-list">
    @if ($jobTitles)
    @foreach($jobTitles as $jobTitle)
    <li onClick="selectCountry('{{$jobTitle->job_title}}');">{{$jobTitle->job_title}}</li>
    @endforeach
    @endif

    @if ($jobTitleOthers)
    @foreach($jobTitleOthers as $jobTitleOther)
    <li onClick="selectCountry('{{$jobTitleOther->job_title}}');">{{$jobTitleOther->job_title}}</li>
    @endforeach
    @endif
</ul>

