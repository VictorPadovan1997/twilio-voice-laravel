

<!DOCTYPE html>
<html>
<head>
  <title>Twilio Client Quickstart</title>
  <link rel="stylesheet" href="{{ url('public/css/site.css') }}">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <style>
   .modal-backdrop {
        z-index: -1;
    }
    </style>
</head>
<body>
    <div id="dialog-confirm" style="display: none;" title="Empty the recycle bin?">
        <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span></p>
    </div>
    <input type="hidden" id="recebeNome"/>
    <ul class="nav flex-column mb-2">
        @foreach ($usuariosOnline as $usuarios)
            @if($usuarios->name != Auth::user()->name)
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="modal" onclick="setaClientName('{{$usuarios->name}}')" data-bs-target="#exampleModal">
                    <span style='color: green' data-feather="circle"></span>
                        {{$usuarios->name}}
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
    <div class="modal fade mt-4" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="client-name"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="controls">
                    <div id="info">
                      <div id="output-selection">
                        <label>Ringtone Devices</label>
                        <select id="ringtone-devices" multiple></select>
                        <label>Speaker Devices</label>
                        <select id="speaker-devices" multiple></select><br/>
                        <a id="get-devices">Seeing unknown devices?</a>
                      </div>
                    </div>
                    <div id="call-controls">
                      <input id="phone-number" type="text" placeholder="Enter a client name" />
                      <button style='color:green' id="button-call">LIGAR</button>
                      <button style='color:red' id="button-hangup">Cancelar</button>
                      <div id="volume-indicators">
                        <label>Volume Microfone</label>
                        <div id="input-volume"></div><br/><br/>
                        <label>Volume Voz</label>
                        <div id="output-volume"></div>
                      </div>
                    </div>
                    <div class= 'md-12' id="log"></div>
                  </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
        </div>
    </div>
    <script type="text/javascript" src="//media.twiliocdn.com/sdk/js/client/v1.7/twilio.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ url('public/js/quickstart.js') }}"></script>
</body>
</html>

