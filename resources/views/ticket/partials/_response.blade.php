<table class="table table-bordered">
    <tbody>
        <tr>
            <td width="20%">
                <div class="text-center">
                    <p>
                        <img src="{{ $response->user->getGravatarUrl() }}" class="rounded-circle" />
                    </p>
                    <p>
                    {{ $response->user->name }}
                    </p>
                </div>
            </td>
            <td valign="top" class="response">
                <div class="response__content">
                    <div class="response__content__body">
                    {!! nl2br(e($response->content)) !!}
                    </div>
                    @if(count($response->attachments) > 0)
                    <div class="response__content__attachments">
                        <div class="dropdown show pull-right">
                            <a class="btn btn-secondary btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="badge badge-pill badge-light">
                                {!! count($response->attachments) !!}
                            </span>
                                Attachments
                            </a>
                        
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                @foreach($response->attachments as $attachment)
                                    <a class="dropdown-item" href="#">
                                        <i class="fa fa-file-pdf-o"></i>
                                        {{ $attachment->name }}
                                        ({{ $attachment->getSizeInKilobytes() }}KB)
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="2">
                {{ $response->created_at->diffForHumans()}}

                <span class="float-right">
                    {{ $response->from }}
                </span>
            </td>
        </tr>
    </tfoot>
</table>
