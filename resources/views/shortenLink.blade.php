<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" />

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<style>
/* Style the body */
body {
  font-family: Arial;
  margin: 0;
}

/* Header/Logo Title */
.header {
  padding: 30px;
  text-align: center;
  background: #28292e;
  color: white;
  font-size: 30px;
}

/* Page Content */
.content {padding:20px;}

</style>

</head>

<body>
   
<div class="container">

<!--
<div class="header">
  <h1>URL Shortener</h1>
</div> -->

    <h1>URL Shortener</h1>
   
    <div class="card">
      
      <div class="card-header">

        @if ($errors->any())
             <div class="alert alert-danger">
            <ul>
                 @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                @endforeach
            </ul>
             </div>
         @endif

        <form method="POST" action="{{ route('generate.shorten.link.post') }}">
            @csrf

            <div class="input-group mb-3">
              <input type="text" name="link" class="form-control" placeholder="Enter URL" aria-label="Recipient's username" aria-describedby="basic-addon2">
              
            </div>

            <div class="input-group mb-3">
            <input type="text" name="code" class="form-control" placeholder="Enter Code">
            </div>


            <input type="checkbox" id="checkauto" name="checkauto" value="Auto Generate">
            <label for="checkauto"> Auto Generate Code</label><br>
            
            <div class="input-group-append">
                <button class="btn btn-primary"  type="submit">Generate</button>
              </div>
        </form>
      </div>
      <div class="card-body">
   
            @if (Session::has('success'))
                <div class="alert alert-success">
                    <p>{{ Session::get('success') }}</p>
                </div>
            @endif
            
            @if (Session::has('error'))
                <div class="alert alert-warning">
                   <p> {{ Session()->get('error') }} </p>
                </div>
            @endif
   
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Short Link</th>
                        <th>Link</th>
                        <th>Visits</th>
                        <th>Action</th>
                
                    </tr>
                </thead>
                <tbody>

                    @foreach($shortLinks as $shortlink)
                    <form action="{{ route('generate.shorten.link.destroy', $shortlink->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <tr>
                            <td>{{ $shortlink->id }}</td>
                            <td><a href="{{ route('shorten.link', $shortlink->code) }}" target="_blank">{{ route('shorten.link', $shortlink->code) }}</a></td>
                            <td>{{ $shortlink->link }}</td>
                            <td>{{ $shortlink->visits }}</td>
                            <td><button type="submit" class="btn btn-danger btn-sm" >Delete</button></td>
                        </tr>
                        </form>
                    @endforeach
                
                </tbody>
            </table>
      </div>
    </div>
   
</div>
    
</body>
</html>
