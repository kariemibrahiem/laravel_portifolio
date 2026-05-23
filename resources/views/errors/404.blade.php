<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#071117">
    <title>404 | Not Found</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Syne:wght@500;700&family=Space+Grotesk:wght@400;500;700&display=swap');

        :root {
            --bg: #071117;
            --bg-soft: rgba(10, 18, 27, 0.82);
            --border: rgba(113, 147, 177, 0.16);
            --text: #eef4f9;
            --muted: #8ea3b8;
            --blue: #4d8dff;
            --lime: #ccff17;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 24px;
            overflow: hidden;
            color: var(--text);
            font-family: 'Space Grotesk', sans-serif;
            background:
                radial-gradient(circle at top left, rgba(77, 141, 255, 0.14), transparent 35%),
                radial-gradient(circle at 80% 20%, rgba(204, 255, 23, 0.10), transparent 20%),
                linear-gradient(180deg, #061018 0%, #071117 45%, #04090d 100%);
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            opacity: 0.16;
            background-image:
                linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
            background-size: 28px 28px;
            mask-image: radial-gradient(circle at center, rgba(0,0,0,0.8), transparent 92%);
        }

        .shell {
            position: relative;
            width: min(100%, 980px);
            padding: 32px;
            border: 1px solid var(--border);
            border-radius: 30px;
            background:
                linear-gradient(180deg, rgba(12, 22, 29, 0.92), rgba(8, 14, 22, 0.82)),
                radial-gradient(circle at top right, rgba(77, 141, 255, 0.12), transparent 28%);
            backdrop-filter: blur(14px);
            box-shadow: 0 24px 80px rgba(0, 0, 0, 0.32);
        }

        .label {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 10px 16px;
            border-radius: 999px;
            color: var(--lime);
            border: 1px solid rgba(204,255,23,0.18);
            background: rgba(9, 18, 18, 0.54);
            letter-spacing: .25em;
            font-size: .72rem;
            text-transform: uppercase;
        }

        .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--lime);
            box-shadow: 0 0 18px rgba(204,255,23,.5);
        }

        .grid {
            display: grid;
            grid-template-columns: minmax(0, 1.05fr) minmax(280px, .95fr);
            gap: 32px;
            align-items: center;
            margin-top: 24px;
        }

        h1 {
            margin: 18px 0 10px;
            font-family: 'Syne', sans-serif;
            font-size: clamp(4rem, 12vw, 8rem);
            line-height: .92;
            letter-spacing: -.05em;
        }

        h2 {
            margin: 0 0 18px;
            font-family: 'Syne', sans-serif;
            font-size: clamp(1.8rem, 4vw, 3.2rem);
            line-height: 1.02;
            letter-spacing: -.03em;
        }

        p {
            margin: 0 0 14px;
            color: var(--muted);
            line-height: 1.8;
            font-size: 1.03rem;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            margin-top: 24px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 50px;
            padding: 0 22px;
            border-radius: 999px;
            text-decoration: none;
            transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn-primary {
            color: #071117;
            background: linear-gradient(135deg, var(--lime), #9cff6e);
            box-shadow: 0 10px 34px rgba(159,255,90,.2);
        }

        .btn-ghost {
            color: var(--text);
            border: 1px solid rgba(106,142,176,.26);
            background: rgba(12, 21, 29, .45);
        }

        .panel {
            position: relative;
            min-height: 320px;
            border-radius: 26px;
            border: 1px solid var(--border);
            background:
                radial-gradient(circle at center, rgba(204,255,23,.12), transparent 30%),
                radial-gradient(circle at 70% 30%, rgba(77,141,255,.14), transparent 22%),
                linear-gradient(180deg, rgba(7,17,23,.85), rgba(7,17,23,.96));
            overflow: hidden;
        }

        .panel::before,
        .panel::after {
            content: "";
            position: absolute;
            border-radius: 50%;
            border: 1px solid rgba(255,255,255,.12);
            inset: 18% 14%;
        }

        .panel::after {
            inset: 28% 24%;
        }

        .panel-label {
            position: absolute;
            top: 18px;
            left: 18px;
            color: var(--blue);
            letter-spacing: .22em;
            font-size: .72rem;
            text-transform: uppercase;
        }

        .panel-code {
            position: absolute;
            right: 18px;
            bottom: 18px;
            color: var(--lime);
            letter-spacing: .18em;
            font-size: .75rem;
            text-transform: uppercase;
        }

        @media (max-width: 760px) {
            .shell {
                padding: 22px;
                border-radius: 24px;
            }

            .grid {
                grid-template-columns: 1fr;
            }

            .panel {
                min-height: 240px;
            }
        }
    </style>
</head>

<body>
    <main class="shell">
        <span class="label"><span class="dot"></span> ROUTE NOT FOUND</span>

        <div class="grid">
            <section>
                <h1>404</h1>
                <h2>The page you requested does not exist.</h2>
                <p>
                    The route <strong>{{ request()->path() }}</strong> could not be resolved.
                    The app is still online, but this endpoint is not available.
                </p>
                <p>
                    You can return to the portfolio homepage or go back to the previous page safely.
                </p>

                <div class="actions">
                    <a class="btn btn-primary" href="{{ url('/') }}">Back Home</a>
                    <a class="btn btn-ghost" href="javascript:history.back()">Go Back</a>
                </div>
            </section>

            <aside class="panel" aria-hidden="true">
                <span class="panel-label">SYSTEM RESPONSE</span>
                <span class="panel-code">404 / NOT FOUND</span>
            </aside>
        </div>
    </main>
</body>

</html>
