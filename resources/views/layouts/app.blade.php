<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siap Kerja Ketapang — Portal Lengkap</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,700;1,9..144,400&display=swap"
        rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0
        }

        :root {
            --navy: #06182C;
            --navy2: #0A2240;
            --teal: #00B37E;
            --teal2: #00D49A;
            --teal-lt: #E6FBF4;
            --amber: #F59E0B;
            --amber-lt: #FEF3C7;
            --coral: #EF4444;
            --coral-lt: #FEE2E2;
            --sky: #3B82F6;
            --sky-lt: #EFF6FF;
            --purple: #8B5CF6;
            --purple-lt: #F5F3FF;
            --green: #16A34A;
            --green-lt: #DCFCE7;
            --pink: #EC4899;
            --pink-lt: #FCE7F3;
            --orange: #EA580C;
            --orange-lt: #FFF7ED;
            --line: #E2E8F0;
            --surface: #F8FAFC;
            --muted: #64748B;
            --subtle: #94A3B8;
            --ink: #0F172A;
            --ink2: #334155;
        }

        html,
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--surface);
            color: var(--ink);
            font-size: 14px;
            min-height: 100vh
        }

        /* ═══════════ PAGE SYSTEM ═══════════ */
        .page {
            display: none
        }

        .page.active {
            display: flex;
            flex-direction: column;
            min-height: 100vh
        }

        /* ═══════════ TOPBAR ═══════════ */
        .topbar {
            background: var(--navy);
            height: 58px;
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 200;
            flex-shrink: 0
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            cursor: pointer
        }

        .brand-hex {
            width: 36px;
            height: 36px;
            background: var(--teal);
            clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0
        }

        .brand-hex svg {
            width: 18px;
            height: 18px
        }

        .brand-txt {
            font-family: 'Fraunces', serif;
            font-size: 17px;
            color: #fff;
            font-weight: 700
        }

        .brand-badge {
            font-size: 9px;
            padding: 2px 8px;
            border-radius: 20px;
            background: var(--teal);
            color: #fff;
            font-weight: 700;
            margin-left: 4px
        }

        .tb-search {
            flex: 1;
            max-width: 440px;
            margin: 0 20px;
            position: relative
        }

        .tb-search input {
            width: 100%;
            padding: 9px 14px 9px 38px;
            background: rgba(255, 255, 255, .08);
            border: 1px solid rgba(255, 255, 255, .12);
            border-radius: 9px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 12px;
            color: #fff;
            outline: none;
            transition: .2s
        }

        .tb-search input::placeholder {
            color: rgba(255, 255, 255, .35)
        }

        .tb-search input:focus {
            background: rgba(255, 255, 255, .13);
            border-color: var(--teal)
        }

        .tb-si {
            position: absolute;
            left: 11px;
            top: 50%;
            transform: translateY(-50%);
            opacity: .4;
            pointer-events: none
        }

        .tb-nav {
            display: flex;
            gap: 2px
        }

        .tbn {
            padding: 7px 12px;
            border-radius: 7px;
            font-size: 11px;
            font-weight: 700;
            color: rgba(255, 255, 255, .55);
            cursor: pointer;
            transition: .15s;
            border: none;
            background: none;
            font-family: 'Plus Jakarta Sans', sans-serif;
            display: flex;
            align-items: center;
            gap: 5px
        }

        .tbn:hover {
            color: #fff;
            background: rgba(255, 255, 255, .08)
        }

        .tbn.active {
            color: #fff;
            background: rgba(255, 255, 255, .12)
        }

        .tbn-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%
        }

        .tb-right {
            display: flex;
            align-items: center;
            gap: 8px
        }

        .xp-pill {
            display: flex;
            align-items: center;
            gap: 5px;
            padding: 5px 10px;
            background: rgba(245, 158, 11, .15);
            border: 1px solid rgba(245, 158, 11, .3);
            border-radius: 20px;
            cursor: pointer
        }

        .xp-val {
            font-size: 11px;
            font-weight: 700;
            color: var(--amber)
        }

        .notif-btn {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: rgba(255, 255, 255, .07);
            border: 1px solid rgba(255, 255, 255, .1);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: rgba(255, 255, 255, .6);
            position: relative;
            transition: .15s
        }

        .notif-btn:hover {
            background: rgba(255, 255, 255, .14)
        }

        .notif-dot {
            width: 7px;
            height: 7px;
            background: var(--coral);
            border-radius: 50%;
            position: absolute;
            top: 7px;
            right: 7px;
            border: 1.5px solid var(--navy)
        }

        .user-pill {
            display: flex;
            align-items: center;
            gap: 7px;
            padding: 5px 12px 5px 5px;
            background: rgba(255, 255, 255, .07);
            border: 1px solid rgba(255, 255, 255, .1);
            border-radius: 20px;
            cursor: pointer;
            transition: .15s
        }

        .user-pill:hover {
            background: rgba(255, 255, 255, .13)
        }

        .ua {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: 800;
            color: #fff
        }

        .un {
            font-size: 11px;
            font-weight: 600;
            color: #fff
        }

        /* ═══════════ LOGIN PAGE ═══════════ */
        #page-login {
            flex-direction: row;
            min-height: 100vh
        }

        .login-left {
            background: var(--navy);
            flex: 1.1;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 44px 52px
        }

        .ll-orb1 {
            position: absolute;
            right: -80px;
            top: -80px;
            width: 440px;
            height: 440px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(0, 179, 126, .28) 0%, transparent 65%);
            animation: drift1 9s ease-in-out infinite
        }

        .ll-orb2 {
            position: absolute;
            left: -60px;
            bottom: -80px;
            width: 340px;
            height: 340px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(59, 130, 246, .18) 0%, transparent 65%);
            animation: drift2 11s ease-in-out infinite
        }

        .ll-grid {
            position: absolute;
            inset: 0;
            background-image: linear-gradient(rgba(255, 255, 255, .03) 1px, transparent 1px), linear-gradient(90deg, rgba(255, 255, 255, .03) 1px, transparent 1px);
            background-size: 50px 50px
        }

        @keyframes drift1 {

            0%,
            100% {
                transform: translate(0, 0)
            }

            50% {
                transform: translate(-24px, 18px)
            }
        }

        @keyframes drift2 {

            0%,
            100% {
                transform: translate(0, 0)
            }

            50% {
                transform: translate(18px, -22px)
            }
        }

        .ll-content {
            position: relative;
            z-index: 1
        }

        .ll-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 56px
        }

        .ll-brand-hex {
            width: 44px;
            height: 44px;
            background: var(--teal);
            clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
            display: flex;
            align-items: center;
            justify-content: center
        }

        .ll-brand-hex svg {
            width: 22px;
            height: 22px
        }

        .ll-brand-name {
            font-family: 'Fraunces', serif;
            font-size: 22px;
            color: #fff;
            font-weight: 700
        }

        .ll-brand-sub {
            font-size: 10px;
            color: rgba(255, 255, 255, .4);
            margin-top: 1px
        }

        .ll-headline {
            font-family: 'Fraunces', serif;
            font-size: 50px;
            line-height: 1.05;
            color: #fff;
            font-weight: 700;
            margin-bottom: 18px
        }

        .ll-headline .acc {
            color: var(--teal2);
            font-style: italic
        }

        .ll-desc {
            font-size: 13px;
            color: rgba(255, 255, 255, .5);
            line-height: 1.8;
            max-width: 400px;
            font-weight: 300;
            margin-bottom: 36px
        }

        .ll-roles {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 10px;
            margin-bottom: 0
        }

        .ll-role {
            background: rgba(255, 255, 255, .06);
            border: 1px solid rgba(255, 255, 255, .1);
            border-radius: 13px;
            padding: 16px 12px;
            text-align: center;
            cursor: pointer;
            transition: .2s
        }

        .ll-role:hover {
            background: rgba(255, 255, 255, .11);
            transform: translateY(-2px)
        }

        .ll-role-icon {
            font-size: 24px;
            margin-bottom: 7px
        }

        .ll-role-name {
            font-size: 11px;
            font-weight: 700;
            color: #fff;
            display: block
        }

        .ll-role-count {
            font-size: 9px;
            color: rgba(255, 255, 255, .35);
            display: block;
            margin-top: 2px
        }

        .ll-stats {
            position: relative;
            z-index: 1;
            display: flex;
            gap: 28px;
            padding-top: 28px;
            border-top: 1px solid rgba(255, 255, 255, .08);
            margin-top: 40px
        }

        .ll-stat-val {
            font-family: 'Fraunces', serif;
            font-size: 28px;
            color: #fff;
            font-weight: 700;
            line-height: 1
        }

        .ll-stat-lbl {
            font-size: 10px;
            color: rgba(255, 255, 255, .35);
            margin-top: 3px
        }

        .login-right {
            width: 460px;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 44px 52px;
            overflow-y: auto
        }

        .lform-wrap {
            width: 100%
        }

        .lform-view {
            display: none;
            animation: fadeUp .3s ease both
        }

        .lform-view.active {
            display: block
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(10px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        .lf-eyebrow {
            display: flex;
            align-items: center;
            gap: 7px;
            margin-bottom: 9px
        }

        .lf-ey-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%
        }

        .lf-ey-txt {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase
        }

        .lf-title {
            font-family: 'Fraunces', serif;
            font-size: 30px;
            color: var(--navy);
            font-weight: 700;
            line-height: 1.1;
            margin-bottom: 6px
        }

        .lf-sub {
            font-size: 12px;
            color: var(--muted);
            margin-bottom: 24px
        }

        .lf-sub a {
            color: var(--teal);
            font-weight: 700;
            text-decoration: none
        }

        .google-btn {
            width: 100%;
            padding: 12px;
            border-radius: 11px;
            border: 2px solid var(--line);
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 13px;
            font-weight: 700;
            color: var(--ink);
            cursor: pointer;
            transition: .2s;
            margin-bottom: 8px;
            position: relative;
            overflow: hidden
        }

        .google-btn:hover {
            border-color: #4285F4;
            background: var(--sky-lt);
            transform: translateY(-1px);
            box-shadow: 0 4px 16px rgba(66, 133, 244, .15)
        }

        .ms-btn {
            width: 100%;
            padding: 12px;
            border-radius: 11px;
            border: 2px solid var(--line);
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 13px;
            font-weight: 700;
            color: var(--ink);
            cursor: pointer;
            transition: .2s;
            margin-bottom: 8px
        }

        .ms-btn:hover {
            border-color: #00A4EF;
            background: #F0F8FF;
            transform: translateY(-1px)
        }

        .or-div {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 16px 0
        }

        .or-line {
            flex: 1;
            height: 1px;
            background: var(--line)
        }

        .or-txt {
            font-size: 11px;
            color: var(--subtle)
        }

        .role-tabs {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 5px;
            background: var(--surface);
            border-radius: 11px;
            padding: 4px;
            margin-bottom: 20px
        }

        .rt {
            padding: 10px 6px;
            border-radius: 8px;
            cursor: pointer;
            text-align: center;
            transition: .15s;
            border: none;
            background: none;
            width: 100%;
            font-family: 'Plus Jakarta Sans', sans-serif
        }

        .rt:hover {
            background: rgba(0, 0, 0, .04)
        }

        .rt.on {
            background: #fff;
            box-shadow: 0 1px 4px rgba(0, 0, 0, .1)
        }

        .rt-icon {
            font-size: 17px;
            display: block;
            margin-bottom: 4px
        }

        .rt-label {
            font-size: 10px;
            font-weight: 700;
            color: var(--muted)
        }

        .rt.on .rt-label {
            color: var(--navy)
        }

        .lf-field {
            margin-bottom: 14px
        }

        .lf-label {
            font-size: 11px;
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 6px;
            display: flex;
            justify-content: space-between
        }

        .lf-label a {
            font-size: 10px;
            color: var(--teal);
            font-weight: 500;
            text-decoration: none
        }

        .lf-input,
        .lf-select {
            width: 100%;
            padding: 11px 14px;
            border: 2px solid var(--line);
            border-radius: 10px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 12px;
            color: var(--ink);
            background: #fff;
            outline: none;
            transition: .2s;
            -webkit-appearance: none
        }

        .lf-input:focus,
        .lf-select:focus {
            border-color: var(--teal);
            box-shadow: 0 0 0 3px rgba(0, 179, 126, .1)
        }

        .lf-input::placeholder {
            color: var(--subtle)
        }

        .pw-wrap {
            position: relative
        }

        .pw-wrap .lf-input {
            padding-right: 44px
        }

        .eye-btn {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: var(--subtle);
            display: flex;
            padding: 4px
        }

        .eye-btn:hover {
            color: var(--navy)
        }

        .pw-bars {
            display: flex;
            gap: 3px;
            margin-top: 6px
        }

        .pw-bar {
            flex: 1;
            height: 3px;
            border-radius: 20px;
            background: var(--line);
            transition: .3s
        }

        .pw-hint {
            font-size: 10px;
            color: var(--subtle);
            margin-top: 4px
        }

        .lf-row2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px
        }

        .cb-row {
            display: flex;
            gap: 9px;
            align-items: flex-start;
            margin-bottom: 14px
        }

        .cb-row input {
            width: 15px;
            height: 15px;
            accent-color: var(--teal);
            flex-shrink: 0;
            margin-top: 2px;
            cursor: pointer
        }

        .cb-row label {
            font-size: 11px;
            color: var(--muted);
            line-height: 1.5
        }

        .cb-row a {
            color: var(--teal)
        }

        .submit-btn {
            width: 100%;
            padding: 13px;
            background: var(--navy);
            border: none;
            border-radius: 11px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 13px;
            font-weight: 700;
            color: #fff;
            cursor: pointer;
            transition: .2s;
            letter-spacing: .2px
        }

        .submit-btn:hover {
            background: var(--teal);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(0, 179, 126, .25)
        }

        .submit-btn.loading {
            background: var(--teal);
            pointer-events: none
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 11px;
            color: var(--muted);
            cursor: pointer;
            border: none;
            background: none;
            font-family: 'Plus Jakarta Sans', sans-serif;
            padding: 0;
            margin-bottom: 18px
        }

        .back-link:hover {
            color: var(--navy)
        }

        /* GOOGLE ROLE PICKER */
        .grole-opt {
            border: 2px solid var(--line);
            border-radius: 12px;
            padding: 15px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 13px;
            transition: .15s;
            margin-bottom: 10px;
            background: #fff
        }

        .grole-opt:hover {
            border-color: var(--teal);
            background: var(--teal-lt)
        }

        .grole-icon {
            font-size: 26px;
            flex-shrink: 0
        }

        .grole-name {
            font-size: 13px;
            font-weight: 700;
            color: var(--navy)
        }

        .grole-sub {
            font-size: 10px;
            color: var(--muted)
        }

        .grole-arr {
            margin-left: auto;
            color: var(--subtle);
            font-size: 16px
        }

        /* ═══════════ MAIN APP LAYOUT ═══════════ */
        .app-body {
            flex: 1;
            display: grid;
            grid-template-columns: 256px 1fr 292px;
            gap: 0;
            max-width: 1280px;
            width: 100%;
            margin: 0 auto;
            padding: 22px;
            gap: 18px
        }

        /* ═══════════ SIDEBAR ═══════════ */
        .sidebar {}

        .sb-card {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 14px;
            padding: 18px;
            margin-bottom: 12px
        }

        .sb-profile {
            text-align: center
        }

        .sb-avatar {
            width: 68px;
            height: 68px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--teal), var(--sky));
            margin: 0 auto 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Fraunces', serif;
            font-size: 26px;
            color: #fff;
            font-weight: 700
        }

        .sb-name {
            font-size: 15px;
            font-weight: 700;
            color: var(--navy)
        }

        .sb-school {
            font-size: 10px;
            color: var(--muted);
            margin-top: 3px
        }

        .sb-score-box {
            background: var(--surface);
            border-radius: 10px;
            padding: 12px;
            margin-top: 14px;
            text-align: center
        }

        .sb-score-val {
            font-family: 'Fraunces', serif;
            font-size: 38px;
            color: var(--teal);
            font-weight: 700;
            line-height: 1
        }

        .sb-score-lbl {
            font-size: 10px;
            color: var(--muted);
            margin-top: 2px
        }

        .pb {
            height: 5px;
            background: var(--line);
            border-radius: 20px;
            overflow: hidden;
            margin-top: 8px
        }

        .pb-fill {
            height: 100%;
            border-radius: 20px;
            background: var(--teal)
        }

        .sb-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            margin-top: 11px;
            justify-content: center
        }

        .sb-tag {
            font-size: 10px;
            padding: 3px 9px;
            border-radius: 20px;
            font-weight: 600
        }

        .sb-sec {
            margin-top: 14px;
            padding-top: 14px;
            border-top: 1px solid var(--line)
        }

        .sb-sec-ttl {
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 8px
        }

        .sbn {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 9px 10px;
            border-radius: 9px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            color: var(--ink2);
            transition: .15s;
            border: none;
            background: none;
            width: 100%;
            font-family: 'Plus Jakarta Sans', sans-serif;
            text-align: left
        }

        .sbn:hover {
            background: var(--surface)
        }

        .sbn.active {
            background: var(--teal-lt);
            color: var(--teal)
        }

        .sbn-icon {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            flex-shrink: 0
        }

        .sbn-badge {
            margin-left: auto;
            font-size: 9px;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 20px
        }

        .xp-box {
            background: var(--navy);
            border-radius: 10px;
            padding: 12px;
            margin-top: 12px;
            text-align: center
        }

        .xp-box-val {
            font-family: 'Fraunces', serif;
            font-size: 22px;
            color: var(--amber);
            font-weight: 700
        }

        .xp-box-lbl {
            font-size: 9px;
            color: rgba(255, 255, 255, .4);
            margin-top: 2px
        }

        .xp-box-bar {
            height: 4px;
            background: rgba(255, 255, 255, .1);
            border-radius: 20px;
            overflow: hidden;
            margin-top: 8px
        }

        .xp-box-fill {
            height: 100%;
            border-radius: 20px;
            background: linear-gradient(90deg, var(--teal), var(--purple))
        }

        /* ═══════════ MAIN COL ═══════════ */
        .main-col {
            min-width: 0
        }

        /* SECTION SYSTEM */
        .sec {
            display: none
        }

        .sec.active {
            display: block
        }

        /* ═══════════ HERO BANNER ═══════════ */
        .hero-banner {
            background: linear-gradient(135deg, var(--navy) 0%, var(--navy2) 55%, #0A2A1C 100%);
            border-radius: 16px;
            padding: 22px 26px;
            margin-bottom: 18px;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            gap: 18px
        }

        .hb-orb {
            position: absolute;
            right: -40px;
            top: -40px;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(0, 179, 126, .12)
        }

        .hb-emoji {
            font-size: 36px;
            flex-shrink: 0;
            position: relative;
            z-index: 1
        }

        .hb-content {
            flex: 1;
            position: relative;
            z-index: 1
        }

        .hb-title {
            font-size: 14px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 3px
        }

        .hb-sub {
            font-size: 11px;
            color: rgba(255, 255, 255, .55)
        }

        .hb-btn {
            padding: 9px 18px;
            background: var(--teal);
            border: none;
            border-radius: 9px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 11px;
            font-weight: 700;
            color: #fff;
            cursor: pointer;
            white-space: nowrap;
            flex-shrink: 0;
            position: relative;
            z-index: 1;
            transition: .15s
        }

        .hb-btn:hover {
            background: var(--teal2)
        }

        /* ═══════════ FILTER ═══════════ */
        .filter-card {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 14px;
            padding: 16px;
            margin-bottom: 16px
        }

        .filter-row {
            display: flex;
            gap: 9px;
            margin-bottom: 12px;
            flex-wrap: wrap
        }

        .f-select {
            padding: 9px 13px;
            border: 2px solid var(--line);
            border-radius: 9px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 11px;
            color: var(--ink);
            background: #fff;
            cursor: pointer;
            outline: none;
            transition: .2s;
            -webkit-appearance: none;
            min-width: 130px;
            font-weight: 500
        }

        .f-select:focus {
            border-color: var(--teal)
        }

        .f-btn {
            padding: 9px 16px;
            border-radius: 9px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            border: none;
            transition: .15s
        }

        .f-btn.go {
            background: var(--navy);
            color: #fff
        }

        .f-btn.go:hover {
            background: var(--teal)
        }

        .f-btn.rst {
            background: var(--surface);
            color: var(--muted);
            border: 1px solid var(--line)
        }

        .chips {
            display: flex;
            gap: 6px;
            flex-wrap: wrap
        }

        .chip {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            border: 2px solid var(--line);
            background: #fff;
            color: var(--muted);
            cursor: pointer;
            transition: .15s
        }

        .chip:hover {
            border-color: #94A3B8;
            color: var(--ink)
        }

        .chip.on {
            background: var(--navy);
            color: #fff;
            border-color: var(--navy)
        }

        /* ═══════════ JOB TABS ═══════════ */
        .job-tabs {
            display: flex;
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 11px;
            padding: 4px;
            margin-bottom: 14px;
            overflow-x: auto
        }

        .jtab {
            flex: 1;
            min-width: max-content;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 700;
            color: var(--muted);
            cursor: pointer;
            text-align: center;
            transition: .15s;
            border: none;
            background: none;
            font-family: 'Plus Jakarta Sans', sans-serif
        }

        .jtab.on {
            background: var(--navy);
            color: #fff
        }

        .jtab:hover:not(.on) {
            background: var(--surface);
            color: var(--navy)
        }

        .jobs-hd {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px
        }

        .jobs-count {
            font-size: 12px;
            font-weight: 700;
            color: var(--navy)
        }

        .jobs-sort {
            padding: 7px 11px;
            border: 2px solid var(--line);
            border-radius: 8px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 11px;
            color: var(--muted);
            background: #fff;
            outline: none;
            cursor: pointer
        }

        /* ═══════════ JOB CARD ═══════════ */
        .job-card {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 14px;
            padding: 18px;
            margin-bottom: 12px;
            cursor: pointer;
            transition: .2s;
            position: relative
        }

        .job-card:hover {
            border-color: #94A3B8;
            box-shadow: 0 6px 24px rgba(0, 0, 0, .07);
            transform: translateY(-1px)
        }

        .job-card.featured {
            border: 2px solid var(--teal)
        }

        .job-card.applied {
            border-color: var(--sky);
            background: #FAFEFF
        }

        .jc-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 9px;
            font-weight: 700;
            padding: 3px 9px;
            border-radius: 20px;
            letter-spacing: .3px
        }

        .jc-head {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            margin-bottom: 12px
        }

        .jc-logo {
            width: 48px;
            height: 48px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
            border: 1px solid var(--line)
        }

        .jc-title {
            font-size: 14px;
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 3px;
            padding-right: 90px;
            line-height: 1.3
        }

        .jc-co {
            font-size: 11px;
            color: var(--muted)
        }

        .jc-tags {
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
            margin-bottom: 10px
        }

        .jt {
            font-size: 10px;
            padding: 3px 9px;
            border-radius: 20px;
            font-weight: 600
        }

        .jc-meta {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
            margin-bottom: 10px
        }

        .jm {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 11px;
            color: var(--muted)
        }

        .jc-desc {
            font-size: 11px;
            color: var(--muted);
            line-height: 1.65;
            margin-bottom: 12px
        }

        .jc-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 8px
        }

        .match-pill {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 11px;
            font-weight: 700;
            padding: 4px 11px;
            border-radius: 20px
        }

        .deadline {
            font-size: 10px;
            color: var(--subtle);
            display: flex;
            align-items: center;
            gap: 4px
        }

        .deadline.urgent {
            color: var(--coral)
        }

        .jc-acts {
            display: flex;
            gap: 6px
        }

        .btn {
            padding: 7px 14px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            border: none;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: .15s;
            display: inline-flex;
            align-items: center;
            gap: 4px
        }

        .btn-teal {
            background: var(--teal);
            color: #fff
        }

        .btn-teal:hover {
            background: var(--teal2)
        }

        .btn-navy {
            background: var(--navy);
            color: #fff
        }

        .btn-navy:hover {
            background: var(--teal)
        }

        .btn-out {
            background: #fff;
            color: var(--navy);
            border: 2px solid var(--line)
        }

        .btn-out:hover {
            background: var(--surface);
            border-color: #94A3B8
        }

        .btn-applied {
            background: var(--sky-lt);
            color: var(--sky);
            border: 2px solid var(--sky-lt)
        }

        .btn-amber {
            background: var(--amber);
            color: #fff
        }

        /* ═══════════ LMS SECTION ═══════════ */
        .lms-hero {
            background: linear-gradient(135deg, var(--navy) 0%, #2D1B69 50%, #0A2240 100%);
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 18px;
            position: relative;
            overflow: hidden
        }

        .lms-orb {
            position: absolute;
            right: -40px;
            top: -40px;
            width: 250px;
            height: 250px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(139, 92, 246, .25) 0%, transparent 65%)
        }

        .lms-grid-bg {
            position: absolute;
            inset: 0;
            background-image: linear-gradient(rgba(255, 255, 255, .025) 1px, transparent 1px), linear-gradient(90deg, rgba(255, 255, 255, .025) 1px, transparent 1px);
            background-size: 44px 44px
        }

        .lms-inner {
            position: relative;
            z-index: 1
        }

        .lms-eyebrow {
            font-size: 10px;
            font-weight: 700;
            color: var(--purple);
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 6px
        }

        .lms-eyebrow span {
            background: rgba(139, 92, 246, .25);
            padding: 2px 8px;
            border-radius: 20px;
            color: #C4B5FD
        }

        .lms-title {
            font-family: 'Fraunces', serif;
            font-size: 26px;
            color: #fff;
            font-weight: 700;
            margin-bottom: 4px
        }

        .lms-sub {
            font-size: 12px;
            color: rgba(255, 255, 255, .5);
            font-weight: 300;
            margin-bottom: 16px
        }

        .lms-xp {
            display: flex;
            align-items: center;
            gap: 14px;
            background: rgba(255, 255, 255, .07);
            border-radius: 10px;
            padding: 12px 14px;
            margin-bottom: 16px
        }

        .xp-num {
            font-family: 'Fraunces', serif;
            font-size: 22px;
            color: var(--amber);
            font-weight: 700
        }

        .xp-lbl {
            font-size: 10px;
            color: rgba(255, 255, 255, .4)
        }

        .lms-prog {
            flex: 1;
            height: 6px;
            background: rgba(255, 255, 255, .1);
            border-radius: 20px;
            overflow: hidden
        }

        .lms-prog-fill {
            height: 100%;
            width: 82%;
            background: linear-gradient(90deg, var(--teal), var(--purple));
            border-radius: 20px
        }

        .jenjang-pills {
            display: flex;
            gap: 8px;
            flex-wrap: wrap
        }

        .jj-pill {
            padding: 8px 16px;
            border-radius: 10px;
            border: 2px solid rgba(255, 255, 255, .15);
            background: rgba(255, 255, 255, .07);
            cursor: pointer;
            font-size: 11px;
            font-weight: 700;
            color: rgba(255, 255, 255, .7);
            transition: .2s;
            display: flex;
            align-items: center;
            gap: 6px
        }

        .jj-pill:hover {
            background: rgba(255, 255, 255, .13);
            color: #fff
        }

        .jj-pill.on {
            border-color: var(--teal);
            background: rgba(0, 179, 126, .2);
            color: var(--teal2)
        }

        .subj-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 14px
        }

        .subj-card {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 13px;
            padding: 15px;
            cursor: pointer;
            transition: .2s;
            position: relative;
            overflow: hidden
        }

        .subj-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            border-radius: 13px 13px 0 0
        }

        .subj-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, .08)
        }

        .sj-emoji {
            font-size: 26px;
            margin-bottom: 8px;
            display: block
        }

        .sj-name {
            font-size: 12px;
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 3px
        }

        .sj-desc {
            font-size: 10px;
            color: var(--muted);
            line-height: 1.5;
            margin-bottom: 9px
        }

        .sj-foot {
            display: flex;
            justify-content: space-between;
            align-items: center
        }

        .sj-lessons {
            font-size: 10px;
            color: var(--subtle)
        }

        .sj-prog {
            width: 50px;
            height: 4px;
            background: var(--line);
            border-radius: 20px;
            overflow: hidden
        }

        .sj-pfill {
            height: 100%;
            border-radius: 20px
        }

        /* ═══════════ PERUSAHAAN (company section in LMS) ═══════════ */
        .perus-card {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 14px;
            padding: 20px;
            margin-bottom: 12px
        }

        .pc-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 12px
        }

        .pc-logo {
            width: 52px;
            height: 52px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: 800;
            color: #fff;
            flex-shrink: 0
        }

        .pc-name {
            font-size: 14px;
            font-weight: 700;
            color: var(--navy)
        }

        .pc-meta {
            font-size: 11px;
            color: var(--muted);
            margin-top: 2px
        }

        .pc-tags {
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
            margin-bottom: 10px
        }

        .pct {
            font-size: 10px;
            padding: 3px 8px;
            border-radius: 20px;
            font-weight: 600
        }

        .pc-stats {
            display: flex;
            gap: 16px;
            margin-bottom: 12px
        }

        .pcs {
            font-size: 11px;
            color: var(--muted)
        }

        .pcs span {
            font-weight: 700;
            color: var(--ink)
        }

        /* ═══════════ RIGHT PANEL ═══════════ */
        .right-panel {}

        .rp-card {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 14px;
            padding: 18px;
            margin-bottom: 14px
        }

        .rp-ttl {
            font-size: 11px;
            font-weight: 800;
            color: var(--navy);
            margin-bottom: 13px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            text-transform: uppercase;
            letter-spacing: .5px
        }

        .rp-see {
            font-size: 10px;
            color: var(--teal);
            font-weight: 500;
            cursor: pointer;
            text-transform: none;
            letter-spacing: 0
        }

        .ri {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 9px 0;
            border-bottom: 1px solid var(--line)
        }

        .ri:last-child {
            border-bottom: none;
            padding-bottom: 0
        }

        .ri-icon {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            flex-shrink: 0
        }

        .ri-name {
            font-size: 11px;
            font-weight: 600;
            color: var(--ink)
        }

        .ri-meta {
            font-size: 10px;
            color: var(--muted);
            margin-top: 1px
        }

        .ri-score {
            font-family: 'Fraunces', serif;
            font-size: 22px;
            color: var(--teal);
            margin-left: auto;
            font-weight: 700;
            flex-shrink: 0
        }

        .dl-row {
            display: flex;
            align-items: flex-start;
            gap: 9px;
            padding: 8px 0;
            border-bottom: 1px solid var(--line)
        }

        .dl-row:last-child {
            border-bottom: none;
            padding-bottom: 0
        }

        .dl-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            flex-shrink: 0;
            margin-top: 4px
        }

        .dl-name {
            font-size: 11px;
            font-weight: 600;
            color: var(--ink)
        }

        .dl-date {
            font-size: 10px;
            margin-top: 2px;
            font-weight: 600
        }

        /* ═══════════ TOAST / XP POPUP ═══════════ */
        .toast {
            position: fixed;
            bottom: 24px;
            right: 24px;
            background: var(--navy);
            color: #fff;
            padding: 11px 18px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
            opacity: 0;
            transform: translateY(16px);
            transition: .3s;
            pointer-events: none;
            z-index: 9999;
            display: flex;
            align-items: center;
            gap: 8px;
            max-width: 320px
        }

        .toast.show {
            opacity: 1;
            transform: translateY(0)
        }

        .xp-popup {
            position: fixed;
            top: 76px;
            right: 24px;
            background: var(--amber);
            color: #fff;
            padding: 10px 18px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 800;
            opacity: 0;
            transform: translateY(-8px);
            transition: .3s;
            pointer-events: none;
            z-index: 9999;
            display: flex;
            align-items: center;
            gap: 6px
        }

        .xp-popup.show {
            opacity: 1;
            transform: translateY(0)
        }

        /* ═══════════ MISC ═══════════ */
        .empty-state {
            text-align: center;
            padding: 48px 20px;
            color: var(--muted)
        }

        .sec-title {
            font-family: 'Fraunces', serif;
            font-size: 20px;
            color: var(--navy);
            font-weight: 700;
            margin-bottom: 14px
        }

        .kpi-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            margin-bottom: 16px
        }

        .kpi {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 12px;
            padding: 14px
        }

        .kpi-val {
            font-family: 'Fraunces', serif;
            font-size: 28px;
            color: var(--navy);
            font-weight: 700;
            line-height: 1
        }

        .kpi-lbl {
            font-size: 10px;
            color: var(--muted);
            margin-top: 3px
        }

        @media(max-width:1100px) {
            .app-body {
                grid-template-columns: 220px 1fr
            }

            .right-panel {
                display: none
            }
        }

        @media(max-width:768px) {
            .app-body {
                grid-template-columns: 1fr
            }

            .sidebar {
                display: none
            }

            #page-login {
                flex-direction: column
            }

            .login-left {
                display: none
            }

            .login-right {
                width: 100%
            }
        }
    </style>
</head>

<body>

    @yield('isi')

    <div class="toast" id="toast"><svg width="14" height="14" viewBox="0 0 24 24" fill="none">
            <path d="M22 11.08V12a10 10 0 11-5.93-9.14" stroke="#00D49A" stroke-width="2.5" />
            <path d="M22 4L12 14.01l-3-3" stroke="#00D49A" stroke-width="2.5" stroke-linecap="round" />
        </svg><span id="toast-msg"></span></div>
    <div class="xp-popup" id="xp-popup">⚡ <span id="xp-msg">+100 XP!</span></div>

    <script>
        // ── STATE ──
        let currentRole = 'pencari_kerja',
            xp = 1240;

        // ── TOAST ──
        function showToast(m) {
            const t = document.getElementById('toast');
            document.getElementById('toast-msg').textContent = m;
            t.classList.add('show');
            setTimeout(() => t.classList.remove('show'), 3000)
        }

        function showXP(pts) {
            const p = document.getElementById('xp-popup');
            document.getElementById('xp-msg').textContent = '+' + pts + ' XP!';
            p.classList.add('show');
            xp += pts;
            document.getElementById('xp-disp').textContent = xp.toLocaleString() + ' XP';
            setTimeout(() => p.classList.remove('show'), 2200)
        }

        // ── LOGIN VIEWS ──
        function showLV(name) {
            document.querySelectorAll('.lform-view').forEach(v => v.classList.remove('active'));
            document.getElementById('lv-' + name).classList.add('active')
        }

        function togglePw(id, btn) {
            const i = document.getElementById(id);
            i.type = i.type === 'password' ? 'text' : 'password';
            btn.style.opacity = i.type === 'text' ? '1' : '.5'
        }

        function checkStrength(pw) {
            const bars = [1, 2, 3, 4].map(i => document.getElementById('pb' + i));
            const h = document.getElementById('pw-hint');
            bars.forEach(b => b.className = 'pw-bar');
            let s = 0;
            if (pw.length >= 8) s++;
            if (/[A-Z]/.test(pw)) s++;
            if (/[0-9]/.test(pw)) s++;
            if (/[^A-Za-z0-9]/.test(pw)) s++;
            const c = s <= 1 ? 'w' : s <= 2 ? 'm' : 's';
            for (let i = 0; i < s; i++) bars[i].classList.add(c);
            h.textContent = ['', 'Lemah', 'Cukup', 'Kuat', 'Sangat Kuat'][s] || 'Min. 8 karakter';
            h.style.color = s <= 1 ? 'var(--coral)' : s <= 2 ? 'var(--amber)' : 'var(--teal)';
        }

        function setLRole(r) {
            currentRole = r;
            ['pencari_kerja', 'perus', 'lpk'].forEach(x => document.getElementById('rt-' + x).classList.remove('on'));
            document.getElementById('rt-' + r).classList.add('on')
        }

        function setRRole(r) {
            ['pencari_kerja', 'perus', 'lpk'].forEach(x => {
                document.getElementById('rtr-' + x).classList.remove('on');
                const f = document.getElementById('rf-' + x);
                if (f) f.style.display = 'none'
            });
            document.getElementById('rtr-' + r).classList.add('on');
            const tf = document.getElementById('rf-' + r);
            if (tf) tf.style.display = 'block'
        }

        function startGoogleFlow() {
            showLV('google')
        }

        function goCompany() {
            showToast('Masuk sebagai perusahaan...');
            setTimeout(() => {
                enterApp('perusahaan')
            }, 800)
        }

        function goLMS() {
            enterApp('lms')
        }

        function enterApp(role) {
            currentRole = role;
            const b = document.getElementById('role-badge');
            const labels = {
                pencari_kerja: 'PENCARI KERJA',
                perusahaan: 'PERUSAHAAN',
                lms: 'BELAJAR',
                lpk: 'LPK'
            };
            const colors = {
                pencari_kerja: 'var(--teal)',
                perusahaan: 'var(--amber)',
                lms: 'var(--purple)',
                lpk: 'var(--sky)'
            };
            b.textContent = labels[role] || 'PENCARI KERJA';
            b.style.background = colors[role] || 'var(--teal)';
            document.getElementById('page-login').classList.remove('active');
            document.getElementById('page-app').classList.add('active');
            if (role === 'perusahaan') {
                showSec('perusahaan');
                switchNav('profil');
                showToast('Selamat datang di Portal Perusahaan!')
            } else if (role === 'lms') {
                showSec('lms');
                switchNav('lms');
                showToast('Selamat belajar! 🎓')
            } else {
                showSec('kerja');
                showToast('Selamat datang, Aldi Ramadan! 👋')
            }
        }

        function doLogin() {
            const e = document.getElementById('l-email').value,
                p = document.getElementById('l-pw').value;
            if (!e || !p) {
                showToast('Mohon isi email dan kata sandi');
                return
            }
            const btn = document.getElementById('login-btn');
            btn.textContent = 'Memverifikasi...';
            btn.classList.add('loading');
            setTimeout(() => {
                btn.classList.remove('loading');
                btn.textContent = 'Masuk →';
                enterApp(currentRole === 'perus' ? 'perusahaan' : currentRole)
            }, 1400)
        }

        function doRegister() {
            if (!document.getElementById('terms').checked) {
                showToast('Harap setujui syarat & ketentuan');
                return
            }
            const btn = document.querySelector('#lv-register .submit-btn');
            btn.textContent = 'Membuat akun...';
            btn.classList.add('loading');
            setTimeout(() => {
                btn.classList.remove('loading');
                btn.textContent = 'Buat Akun Gratis →';
                showToast('Akun berhasil dibuat!');
                showLV('main')
            }, 1500)
        }

        function doForgot() {
            showToast('Tautan reset dikirim!');
            setTimeout(() => showLV('main'), 1600)
        }

        // ── APP NAVIGATION ──
        function switchNav(name) {
            document.querySelectorAll('.tbn').forEach(b => b.classList.remove('active'));
            const tn = document.getElementById('tn-' + name);
            if (tn) tn.classList.add('active');
            const map = {
                kerja: 'kerja',
                lms: 'lms',
                lamaran: 'lamaran',
                profil: 'profil'
            };
            showSec(map[name] || name);
        }

        function showSec(name) {
            document.querySelectorAll('.sec').forEach(s => s.classList.remove('active'));
            document.querySelectorAll('.sbn').forEach(b => b.classList.remove('active'));
            const sec = document.getElementById('sec-' + name);
            if (sec) sec.classList.add('active');
            const sbn = document.getElementById('sbn-' + name);
            if (sbn) sbn.classList.add('active');
        }

        function switchToCompany() {
            enterApp('perusahaan')
        }

        // ── JOBS ──
        const allCards = () => Array.from(document.querySelectorAll('.job-card'));

        function filterJobs() {
            const sektor = document.getElementById('f-sektor').value;
            const q = document.getElementById('gs-input').value.toLowerCase();
            let v = 0;
            allCards().forEach(c => {
                const t = (c.querySelector('.jc-title') || {}).textContent?.toLowerCase() || '';
                const co = (c.querySelector('.jc-co') || {}).textContent?.toLowerCase() || '';
                const cs = c.dataset.sektor || '';
                const show = (!q || t.includes(q) || co.includes(q)) && (!sektor || cs === sektor);
                c.style.display = show ? 'block' : 'none';
                if (show) v++;
            });
            const el = document.getElementById('jobs-count');
            if (el) el.textContent = 'Menampilkan ' + v + ' lowongan';
        }

        function globalSearch(q) {
            filterJobs()
        }

        function resetFilter() {
            ['f-sektor', 'f-kec', 'f-tipe'].forEach(id => {
                const el = document.getElementById(id);
                if (el) el.value = ''
            });
            document.getElementById('gs-input').value = '';
            filterJobs();
            document.querySelectorAll('.chip').forEach((c, i) => {
                c.classList.remove('on');
                if (i === 0) c.classList.add('on')
            });
            showToast('Filter direset');
        }

        function setChip(el, type) {
            document.querySelectorAll('.chip').forEach(c => c.classList.remove('on'));
            el.classList.add('on')
        }

        function setJtab(el) {
            document.querySelectorAll('.jtab').forEach(t => t.classList.remove('on'));
            el.classList.add('on')
        }

        function applyJob(btn, company) {
            const card = btn.closest('.job-card');
            btn.textContent = '✓ Terkirim!';
            btn.className = 'btn btn-applied';
            btn.disabled = true;
            card.classList.add('applied');
            showToast('Lamaran ke ' + company + ' berhasil dikirim!');
            showXP(50);
        }

        function saveJob(btn) {
            const saved = btn.textContent.includes('Tersimpan');
            btn.textContent = saved ? '🔖 Simpan' : '✓ Tersimpan';
            btn.style.background = saved ? '' : 'var(--purple-lt)';
            btn.style.color = saved ? '' : 'var(--purple)';
            showToast(saved ? 'Dihapus dari simpan' : 'Lowongan disimpan!');
        }

        // ── LMS ──
        const lmsData = {
            sd: {
                label: '🌱 SD — Kelas 1–6 (Kurikulum Merdeka)',
                subjects: [{
                    e: '📐',
                    n: 'Matematika',
                    d: 'Bilangan, geometri, literasi numerasi',
                    l: 24,
                    p: 90,
                    c: 'var(--green)'
                }, {
                    e: '📝',
                    n: 'Bahasa Indonesia',
                    d: 'Literasi membaca, menulis, bercerita',
                    l: 20,
                    p: 75,
                    c: 'var(--sky)'
                }, {
                    e: '🔬',
                    n: 'IPAS',
                    d: 'IPA & IPS tematik, lingkungan Ketapang',
                    l: 18,
                    p: 60,
                    c: 'var(--teal)'
                }, {
                    e: '🇮🇩',
                    n: 'Pendidikan Pancasila',
                    d: 'Nilai Pancasila, kebinekaan, gotong royong',
                    l: 16,
                    p: 50,
                    c: 'var(--coral)'
                }, {
                    e: '🎨',
                    n: 'Seni Budaya & Prakarya',
                    d: 'Seni rupa, tari Dayak, kerajinan lokal',
                    l: 14,
                    p: 40,
                    c: 'var(--pink)'
                }, {
                    e: '⚽',
                    n: 'PJOK',
                    d: 'Olahraga, kesehatan, permainan tradisional',
                    l: 12,
                    p: 80,
                    c: 'var(--orange)'
                }]
            },
            smp: {
                label: '📖 SMP — Kelas 7–9 (Kurikulum Merdeka)',
                subjects: [{
                    e: '📐',
                    n: 'Matematika',
                    d: 'Aljabar, geometri, statistika, fungsi',
                    l: 32,
                    p: 70,
                    c: 'var(--sky)'
                }, {
                    e: '⚗️',
                    n: 'IPA Terpadu',
                    d: 'Fisika, kimia, biologi. Ekosistem Kalimantan',
                    l: 28,
                    p: 55,
                    c: 'var(--teal)'
                }, {
                    e: '🗺️',
                    n: 'IPS Terpadu',
                    d: 'Sejarah, geografi, ekonomi, sosiologi',
                    l: 26,
                    p: 85,
                    c: 'var(--amber)'
                }, {
                    e: '🌍',
                    n: 'Bahasa Inggris',
                    d: 'Reading, writing, speaking, listening',
                    l: 24,
                    p: 45,
                    c: 'var(--purple)'
                }, {
                    e: '💻',
                    n: 'Informatika',
                    d: 'Python dasar, algoritma, keamanan digital',
                    l: 20,
                    p: 30,
                    c: 'var(--sky)'
                }, {
                    e: '📝',
                    n: 'Bahasa Indonesia',
                    d: 'Teks eksposisi, diskusi, pidato, cerpen',
                    l: 22,
                    p: 90,
                    c: 'var(--coral)'
                }]
            },
            sma: {
                label: '🔬 SMA — Kelas 10–12 IPA & IPS (Kurikulum Merdeka)',
                subjects: [{
                    e: '∫',
                    n: 'Matematika Peminatan',
                    d: 'Kalkulus, trigonometri, matriks, vektor',
                    l: 36,
                    p: 60,
                    c: 'var(--purple)'
                }, {
                    e: '⚡',
                    n: 'Fisika',
                    d: 'Mekanika, listrik, gelombang, fisika modern',
                    l: 30,
                    p: 50,
                    c: 'var(--sky)'
                }, {
                    e: '🧪',
                    n: 'Kimia',
                    d: 'Stoikiometri, elektrokimia, kimia organik',
                    l: 28,
                    p: 45,
                    c: 'var(--teal)'
                }, {
                    e: '🧬',
                    n: 'Biologi',
                    d: 'Sel, genetika, ekosistem tropis Kalimantan',
                    l: 28,
                    p: 75,
                    c: 'var(--green)'
                }, {
                    e: '📊',
                    n: 'Ekonomi',
                    d: 'Mikro & makro, APBN, perdagangan',
                    l: 26,
                    p: 65,
                    c: 'var(--amber)'
                }, {
                    e: '💻',
                    n: 'Informatika',
                    d: 'Python, SQL, jaringan, AI dasar',
                    l: 24,
                    p: 35,
                    c: 'var(--navy)'
                }]
            },
            smk: {
                label: '⚙️ SMK Kejuruan — ATP Kelas XII (Kurikulum Merdeka Vokasi)',
                subjects: [{
                    e: '🌿',
                    n: 'Pemupukan Presisi',
                    d: 'Nutrisi tanaman, teknik aplikasi berbasis data',
                    l: 16,
                    p: 40,
                    c: 'var(--teal)'
                }, {
                    e: '🚜',
                    n: 'Mekanisasi Pertanian',
                    d: 'Traktor, alsintan, K3 lapangan',
                    l: 14,
                    p: 65,
                    c: 'var(--green)'
                }, {
                    e: '♻️',
                    n: 'Standar RSPO',
                    d: 'Monitoring lingkungan, keberlanjutan, audit',
                    l: 12,
                    p: 25,
                    c: 'var(--amber)'
                }, {
                    e: '⛑️',
                    n: 'K3 Perkebunan',
                    d: 'APD, bahan kimia, P3K darurat',
                    l: 10,
                    p: 80,
                    c: 'var(--coral)'
                }, {
                    e: '🐛',
                    n: 'Pengendalian OPT',
                    d: 'Hama, penyakit, pestisida nabati, PHT',
                    l: 12,
                    p: 55,
                    c: 'var(--amber)'
                }, {
                    e: '📐',
                    n: 'Matematika XII',
                    d: 'Statistika, barisan deret, program linear',
                    l: 24,
                    p: 65,
                    c: 'var(--purple)'
                }]
            }
        };

        function setJenjang(j) {
            document.querySelectorAll('.jj-pill').forEach(p => p.classList.remove('on'));
            event.target.closest('.jj-pill').classList.add('on');
            const data = lmsData[j];
            if (!data) return;
            document.getElementById('lms-jenjang-label').textContent = data.label;
            const grid = document.getElementById('subj-grid');
            grid.innerHTML = data.subjects.map(s => `
    <div class="subj-card" onclick="openLesson('${s.n}')">
      <div style="background:${s.c};position:absolute;top:0;left:0;right:0;height:3px;border-radius:13px 13px 0 0"></div>
      <span class="sj-emoji">${s.e}</span>
      <div class="sj-name">${s.n}</div>
      <div class="sj-desc">${s.d}</div>
      <div class="sj-foot"><span class="sj-lessons">${s.l} pertemuan</span>
        <div class="sj-prog"><div class="sj-pfill" style="width:${s.p}%;background:${s.c}"></div></div>
      </div>
    </div>`).join('');
        }

        function openLesson(title) {
            showToast('Membuka materi: ' + title + ' ...');
            showXP(10)
        }
    </script>
</body>

</html>
