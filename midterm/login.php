<?php include './parts/head.php' ?>
    <title>登入</title>
    <style>

    </style>
</head>
<body>
<div
      class="block bg-secondary-subtle w-50 h-50 position-absolute rounded-4 border border-secondary translate-middle Regular shadow top-50 start-50"
    >
      <div class="h1 text-center pt-5 pb-3 fw-bold">LOGIN</div>
      <div class="mb-3 px-3 hstack gap-3">
        <label for="exampleFormControlInput1" class="form-label">Email</label>
        <input
          type="email"
          class="form-control"
          id="exampleFormControlInput1"
          placeholder="name@example.com"
        />
      </div>
      <div class="mb-3 px-3 hstack gap-3">
        d
        <label for="exampleFormControlInput1" class="form-label"
          >Password</label
        >
        <input
          type="password"
          class="form-control"
          id="exampleFormControlInput1"
          placeholder="password, please"
        />
      </div>
      <div class="d-grid gap-2 d-md-flex justify-content-md-end px-3">
        <button class="btn btn-primary me-md-2" type="button">Login</button>
        <button class="btn btn-warning" type="button">Cancel</button>
      </div>
    </div>



<?php include './parts/foot.php' ?>