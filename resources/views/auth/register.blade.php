{{-- resources/views/auth/register.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sign up · SkillFokio</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700&family=Hanken+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
  :root{
    --bg:#f4efe6; --card:#fbf8f2; --ink:#211c16; --muted:#6f655a;
    --accent:#c0532a; --accent-soft:rgba(192,83,42,.10);
    --line:rgba(33,28,22,.14); --err:#b3261e;
    --shadow:0 30px 60px -25px rgba(33,28,22,.28);
  }
  *{box-sizing:border-box;margin:0;padding:0}
  body{
    font-family:'Hanken Grotesk',sans-serif;background:var(--bg);color:var(--ink);
    min-height:100vh;-webkit-font-smoothing:antialiased;padding:clamp(20px,5vw,56px);
    background-image:radial-gradient(rgba(33,28,22,.025) 1px,transparent 1px);background-size:22px 22px;
  }
  .brand{display:flex;align-items:center;justify-content:center;gap:10px;font-weight:700;font-size:22px;letter-spacing:-.02em;margin-bottom:8px}
  .brand .mark{width:32px;height:32px;border-radius:9px;background:var(--accent);display:grid;place-items:center;color:#fff;font-family:'Fraunces',serif;font-weight:600;font-size:19px;transform:rotate(-6deg)}
  .brand span{color:var(--accent)}
  .lead{text-align:center;color:var(--muted);font-size:15px;margin-bottom:30px}

  .card{
    max-width:760px;margin:0 auto;background:var(--card);border:1px solid var(--line);
    border-radius:24px;box-shadow:var(--shadow);overflow:hidden;
  }
  .card-head{padding:clamp(26px,4vw,38px) clamp(26px,4vw,40px) 0}
  .card-head h1{font-family:'Fraunces',serif;font-weight:600;font-size:clamp(26px,4vw,36px);letter-spacing:-.02em}
  .card-head p{color:var(--muted);margin-top:6px;font-size:15px}

  form{padding:clamp(22px,4vw,36px) clamp(26px,4vw,40px) clamp(28px,4vw,40px)}
  .section-label{
    display:flex;align-items:center;gap:12px;margin:26px 0 16px;
    font-size:12px;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:var(--accent);
  }
  .section-label::after{content:"";flex:1;height:1px;background:var(--line)}
  .section-label:first-child{margin-top:0}

  .grid{display:grid;grid-template-columns:repeat(2,1fr);gap:18px 22px}
  @media(max-width:600px){.grid{grid-template-columns:1fr}}
  .full{grid-column:1 / -1}

  .field label{display:block;font-size:13.5px;font-weight:600;margin-bottom:7px}
  .field .req{color:var(--accent)}
  .field input{
    width:100%;padding:12px 14px;font:inherit;font-size:15px;color:var(--ink);
    background:var(--bg);border:1px solid var(--line);border-radius:11px;transition:border .18s,box-shadow .18s;
  }
  .field input::placeholder{color:#a59a8c}
  .field input:focus{outline:none;border-color:var(--accent);box-shadow:0 0 0 3px var(--accent-soft)}
  .field input.is-invalid{border-color:var(--err)}
  .error{color:var(--err);font-size:12.5px;margin-top:6px;font-weight:500}

  .btn{
    width:100%;margin-top:30px;padding:15px;border:none;border-radius:13px;cursor:pointer;
    background:var(--accent);color:#fff;font:inherit;font-size:16px;font-weight:700;letter-spacing:.01em;
    transition:transform .15s,filter .15s;
  }
  .btn:hover{filter:brightness(1.06);transform:translateY(-1px)}
  .btn:active{transform:translateY(0)}

  .alt{text-align:center;margin-top:22px;font-size:14.5px;color:var(--muted)}
  .alt a{color:var(--accent);font-weight:600;text-decoration:none}
  .alt a:hover{text-decoration:underline}
</style>
</head>
<body>

  <div class="brand"><span class="mark">S</span>Skill<span>Fokio</span></div>
  <p class="lead">Build a CV-ready profile and track your skills.</p>

  <div class="card">
    <div class="card-head">
      <h1>Create your account</h1>
      <p>Start with the basics — you can refine your profile anytime.</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
      @csrf

      {{-- ACCOUNT --}}
      <div class="section-label">Account</div>
      <div class="grid">
        <div class="field full">
          <label for="name">Full name <span class="req">*</span></label>
          <input id="name" name="name" type="text" value="{{ old('name') }}"
                 placeholder="Amara Mensah" required autofocus
                 class="@error('name') is-invalid @enderror">
          @error('name')<div class="error">{{ $message }}</div>@enderror
        </div>

        <div class="field full">
          <label for="email">Professional email <span class="req">*</span></label>
          <input id="email" name="email" type="email" value="{{ old('email') }}"
                 placeholder="you@email.com" required
                 class="@error('email') is-invalid @enderror">
          @error('email')<div class="error">{{ $message }}</div>@enderror
        </div>

        <div class="field">
          <label for="password">Password <span class="req">*</span></label>
          <input id="password" name="password" type="password"
                 placeholder="••••••••" required
                 class="@error('password') is-invalid @enderror">
          @error('password')<div class="error">{{ $message }}</div>@enderror
        </div>

        <div class="field">
          <label for="password_confirmation">Confirm password <span class="req">*</span></label>
          <input id="password_confirmation" name="password_confirmation" type="password"
                 placeholder="••••••••" required>
        </div>
      </div>

      {{-- CV HEADER --}}
      <div class="section-label">CV Header</div>
      <div class="grid">
        <div class="field">
          <label for="professional_title">Professional title</label>
          <input id="professional_title" name="professional_title" type="text"
                 value="{{ old('professional_title') }}" placeholder="Junior Full-Stack Developer"
                 class="@error('professional_title') is-invalid @enderror">
          @error('professional_title')<div class="error">{{ $message }}</div>@enderror
        </div>

        <div class="field">
          <label for="phone">Phone number</label>
          <input id="phone" name="phone" type="tel" value="{{ old('phone') }}"
                 placeholder="+44 7700 900123"
                 class="@error('phone') is-invalid @enderror">
          @error('phone')<div class="error">{{ $message }}</div>@enderror
        </div>

        <div class="field">
          <label for="university">University</label>
          <input id="university" name="university" type="text" value="{{ old('university') }}"
                 placeholder="University of Sheffield"
                 class="@error('university') is-invalid @enderror">
          @error('university')<div class="error">{{ $message }}</div>@enderror
        </div>

        <div class="field">
          <label for="course">Course</label>
          <input id="course" name="course" type="text" value="{{ old('course') }}"
                 placeholder="BSc Computer Science"
                 class="@error('course') is-invalid @enderror">
          @error('course')<div class="error">{{ $message }}</div>@enderror
        </div>

        <div class="field">
          <label for="city">City</label>
          <input id="city" name="city" type="text" value="{{ old('city') }}"
                 placeholder="Sheffield"
                 class="@error('city') is-invalid @enderror">
          @error('city')<div class="error">{{ $message }}</div>@enderror
        </div>

        <div class="field">
          <label for="country">Country</label>
          <input id="country" name="country" type="text" value="{{ old('country') }}"
                 placeholder="United Kingdom"
                 class="@error('country') is-invalid @enderror">
          @error('country')<div class="error">{{ $message }}</div>@enderror
        </div>

        <div class="field full">
          <label for="linkedin_url">LinkedIn profile</label>
          <input id="linkedin_url" name="linkedin_url" type="url" value="{{ old('linkedin_url') }}"
                 placeholder="https://linkedin.com/in/yourname"
                 class="@error('linkedin_url') is-invalid @enderror">
          @error('linkedin_url')<div class="error">{{ $message }}</div>@enderror
        </div>

        <div class="field">
          <label for="github_url">GitHub</label>
          <input id="github_url" name="github_url" type="url" value="{{ old('github_url') }}"
                 placeholder="https://github.com/yourname"
                 class="@error('github_url') is-invalid @enderror">
          @error('github_url')<div class="error">{{ $message }}</div>@enderror
        </div>

        <div class="field">
          <label for="portfolio_url">Portfolio / Website</label>
          <input id="portfolio_url" name="portfolio_url" type="url" value="{{ old('portfolio_url') }}"
                 placeholder="https://yourname.dev"
                 class="@error('portfolio_url') is-invalid @enderror">
          @error('portfolio_url')<div class="error">{{ $message }}</div>@enderror
        </div>
      </div>

      <button type="submit" class="btn">Create account</button>

      <p class="alt">Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
    </form>
  </div>

</body>
</html>
