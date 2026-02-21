<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Forgot Password</title>
<link href="https://fonts.googleapis.com/css2?family=Geist:wght@300;400;500&display=swap" rel="stylesheet">
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  body {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #fafafa;
    font-family: 'Geist', sans-serif;
    color: #111;
  }

  .card {
    width: 100%;
    max-width: 380px;
    padding: 0 24px;
    animation: up 0.5s ease both;
  }

  @keyframes up {
    from { opacity: 0; transform: translateY(14px); }
    to { opacity: 1; transform: translateY(0); }
  }

  .step {
    font-size: 11px;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    color: #bbb;
    margin-bottom: 32px;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .step-dots { display: flex; gap: 4px; }
  .dot { width: 16px; height: 2px; background: #e0e0e0; border-radius: 2px; transition: all 0.3s; }
  .dot.active { background: #111; width: 28px; }
  .dot.done { background: #ccc; }

  h1 { font-size: 22px; font-weight: 500; letter-spacing: -0.4px; margin-bottom: 6px; }

  .sub { font-size: 14px; color: #999; margin-bottom: 40px; line-height: 1.6; }

  label { display: block; font-size: 12px; color: #bbb; margin-bottom: 8px; letter-spacing: 0.3px; }

  input {
    width: 100%;
    padding: 11px 0;
    border: none;
    border-bottom: 1px solid #e8e8e8;
    background: transparent;
    font-family: 'Geist', sans-serif;
    font-size: 15px;
    color: #111;
    outline: none;
    transition: border-color 0.2s;
  }
  input:focus { border-bottom-color: #111; }
  input::placeholder { color: #ddd; }

  .field { margin-bottom: 24px; }

  button {
    width: 100%;
    margin-top: 32px;
    padding: 13px;
    background: #111;
    color: #fff;
    border: none;
    border-radius: 8px;
    font-family: 'Geist', sans-serif;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    letter-spacing: 0.1px;
    transition: opacity 0.2s;
  }
  button:hover { opacity: 0.8; }

  .footer { text-align: center; margin-top: 28px; font-size: 13px; color: #bbb; }
  .footer a { color: #555; text-decoration: none; }
  .footer a:hover { color: #111; }
</style>
</head>
<body>
<div class="card">
  <div class="step">
    <div class="step-dots">
      <div class="dot active"></div>
      <div class="dot"></div>
      <div class="dot"></div>
    </div>
    1 of 3
  </div>

  <h1>Forgot password?</h1>
  <p class="sub">We'll send a one-time code to your email.</p>

  <form method="POST" action="{{ route('password.sendOtp') }}">
    @csrf
    <div class="field">
      <label for="email">Email</label>
      <input type="email" id="email" name="email" placeholder="you@example.com" required>
    </div>
    <button type="submit">Send code</button>
  </form>

  <p class="footer"><a href="{{route('login')}}">Back to log in</a></p>
</div>
</body>
</html>