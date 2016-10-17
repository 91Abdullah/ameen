<ul class="inbox-nav margin-bottom-10">
    <li class="compose-btn">
        <a href="{{ route('admin.emails.compose') }}" data-title="Compose" class="btn green">
            <i class="fa fa-edit"></i> Compose </a>
    </li>
    <li class="inbox {{ Request::is('emails/inbox') || Request::is('emails/inbox/*') ? 'active' : '' }}">
        <a href="{{ route('admin.emails') }}" class="btn" data-title="Inbox">
            Inbox({{ session('total_messages') }}) </a>
        <b></b>
    </li>
    <li class="sent {{ Request::is('emails/sent') || Request::is('emails/sent/*') ? 'active' : '' }}">
        <a class="btn" href="{{ route('admin.emails.sent') }}" data-title="Sent">
            Sent </a>
        <b></b>
    </li>
    <li class="draft {{ Request::is('emails/draft') || Request::is('emails/draft/*') ? 'active' : '' }}">
        <a class="btn" href="javascript:;" data-title="Draft">
            Draft </a>
        <b></b>
    </li>
    <li class="trash {{ Request::is('emails/trash') || Request::is('emails/trash/*') ? 'active' : '' }}">
        <a class="btn" href="javascript:;" data-title="Trash">
            Trash </a>
        <b></b>
    </li>
</ul>