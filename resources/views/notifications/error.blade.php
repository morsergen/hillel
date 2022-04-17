<b>Error in site {{ env('APP_URL') }}</b>
<b>Code: </b> {{ $error->getCode() }}
<b>Message: </b> {{ $error->getMessage() }}
<b>File: </b> {{ $error->getFile() }}
<b>Line: </b> {{ $error->getLine() }}
