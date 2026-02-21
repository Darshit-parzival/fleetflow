<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Reset Password</title>
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
  .dot { width: 16px; height: 2px; background: #e0e0e0; border-radius: 2px; }
  .dot.active { background: #111; width: 28px; }
  .dot.done { background: #ccc; }

  h1 { font-size: 22px; font-weight: 500; letter-spacing: -0.4px; margin-bottom: 6px; }
  .sub { font-size: 14px; color: #999; margin-bottom: 40px; line-height: 1.6; }

  label { display: block; font-size: 12px; color: #bbb; margin-bottom: 8px; letter-spacing: 0.3px; }

  .input-wrap { position: relative; }

  input {
    width: 100%;
    padding: 11px 36px 11px 0;
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

  .toggle {
    position: absolute; right: 0; top: 50%; transform: translateY(-50%);
    background: none; border: none; font-family: 'Geist', sans-serif;
    font-size: 12px; color: #bbb; cursor: pointer; padding: 4px;
    width: auto; margin: 0;
  }
  .toggle:hover { color: #111; opacity: 1; }

  .field { margin-bottom: 28px; }

  .match { font-size: 12px; margin-top: 8px; min-height: 16px; }

  button.submit {
    width: 100%;
    margin-top: 8px;
    padding: 13px;
    background: #111;
    color: #fff;
    border: none;
    border-radius: 8px;
    font-family: 'Geist', sans-serif;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: opacity 0.2s;
  }
  button.submit:hover { opacity: 0.8; }
</style>
</head>
<body>
<div class="card">
  <div class="step">
    <div class="step-dots">
      <div class="dot done"></div>
      <div class="dot done"></div>
      <div class="dot active"></div>
    </div>
    3 of 3
  </div>

  <h1>New password</h1>
  <p class="sub">Choose something you haven't used before.</p>

  <form method="POST" action="{{ route('password.reset') }}">
    @csrf
    <input type="hidden" name="email" value="{{ $email }}">

    <div class="field">
      <label for="password">Password</label>
      <div class="input-wrap">
        <input type="password" id="password" name="password" placeholder="New password" required oninput="checkMatch()">
        <button type="button" class="toggle" onclick="toggle('password', this)">show</button>
      </div>
    </div>

    <div class="field">
      <label for="password_confirmation">Confirm</label>
      <div class="input-wrap">
        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Repeat password" required oninput="checkMatch()">
        <button type="button" class="toggle" onclick="toggle('password_confirmation', this)">show</button>
      </div>
      <div class="match" id="matchNote"></div>
    </div>

    <button type="submit" class="submit">Reset password</button>
  </form>
</div>

<script>
function toggle(id, btn) {
  const el = document.getElementById(id);
  el.type = el.type === 'password' ? 'text' : 'password';
  btn.textContent = el.type === 'password' ? 'show' : 'hide';
}

function checkMatch() {
  const pw = document.getElementById('password').value;
  const cf = document.getElementById('password_confirmation').value;
  const note = document.getElementById('matchNote');
  if (!cf) { note.textContent = ''; return; }
  note.textContent = pw === cf ? '✓ Passwords match' : '✗ Does not match';
  note.style.color = pw === cf ? '#888' : '#e05050';
}
</script>
</body>
</html>