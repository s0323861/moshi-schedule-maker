<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>模試日程メーカー - 模試日程をGoogleカレンダーへ追加</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <style>
    body {
        min-height: 100vh;
        background:
            linear-gradient(
                135deg,
                #eef7ff 0%,
                #f7f2ff 50%,
                #fff8f0 100%
            );
    }

    .hero-section {
        padding: 3rem 1.5rem;
        color: #fff;
        border-radius: 24px;
        background:
            linear-gradient(
                135deg,
                #4f7cff,
                #8b5cf6
            );
        box-shadow: 0 12px 30px rgba(79, 124, 255, 0.25);
    }

    .hero-section h1 {
        font-size: clamp(2rem, 5vw, 3rem);
    }

    .hero-section p {
        font-size: 1.05rem;
        opacity: 0.95;
    }

    .hero-icon {
        font-size: 3rem;
    }

    .exam-type-card {
        position: relative;
        padding: 0;
        margin-bottom: 0.75rem;
    }

    .exam-type-card .form-check-input {
        position: absolute;
        top: 50%;
        left: 1rem;
        margin: 0;
        transform: translateY(-50%);
    }

    .exam-type-card .form-check-label {
        display: block;
        width: 100%;
        padding: 1rem 1rem 1rem 3rem;
        font-weight: 600;
        cursor: pointer;
        border: 2px solid #e5e7eb;
        border-radius: 14px;
        background-color: #fff;
        transition:
            color 0.25s ease,
            border-color 0.25s ease,
            background-color 0.25s ease,
            box-shadow 0.25s ease,
            transform 0.25s ease;
    }

    .exam-type-card .form-check-label:hover {
        transform: translateY(-2px);
        border-color: #8b5cf6;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
    }

    .exam-type-card .form-check-input:checked
    + .form-check-label {
        transform: translateY(-3px);
        color: #5b3fd4;
        border-color: #8b5cf6;
        background-color: #f4f0ff;
        box-shadow:
            0 10px 24px
            rgba(139, 92, 246, 0.2);
    }

    .exam-event {
        position: relative;
        padding: 0;
        margin-bottom: 0.75rem;
    }

    .exam-event .form-check-input {
        position: absolute;
        top: 50%;
        left: 1rem;
        z-index: 2;
        margin: 0;
        transform: translateY(-50%);
    }

    .exam-event .form-check-label {
        display: block;
        width: 100%;
        min-height: 72px;
        padding: 0.85rem 1rem 0.85rem 3rem;
        cursor: pointer;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        background-color: #fff;
        transition:
            border-color 0.25s ease,
            background-color 0.25s ease,
            box-shadow 0.25s ease,
            transform 0.25s ease;
    }

    .exam-event .form-check-label:hover {
        transform: translateY(-1px);
        border-color: #4f7cff;
        background-color: #f8faff;
    }

    .exam-event .form-check-input:checked
    + .form-check-label {
        transform: translateY(-3px);
        border-color: #4f7cff;
        background-color: #edf4ff;
        box-shadow:
            0 10px 24px
            rgba(79, 124, 255, 0.22);
    }

    .exam-event .form-check-label > div {
        font-weight: 700;
        color: #334155;
    }

    .exam-event small {
        display: block;
        margin-top: 0.2rem;
        font-size: 0.9rem;
    }

    .card {
        border: 0;
        border-radius: 20px;
        overflow: hidden;
    }

    .card-header {
        padding: 1rem 1.25rem;
        font-weight: 700;
        background-color: #fff;
        border-bottom: 1px solid #edf0f5;
    }

    .step-badge {
        display: inline-block;
        padding: 0.3rem 0.65rem;
        margin-right: 0.5rem;
        color: #fff;
        font-size: 0.75rem;
        border-radius: 999px;
        background:
            linear-gradient(
                135deg,
                #4f7cff,
                #8b5cf6
            );
    }

    #submitBtn {
        min-height: 58px;
        font-weight: 700;
        border: 0;
        border-radius: 16px;
        background:
            linear-gradient(
                135deg,
                #4285f4,
                #7c5cff
            );
        box-shadow: 0 8px 20px rgba(66, 133, 244, 0.25);
        transition: 0.2s;
    }

    #submitBtn:not(:disabled):hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 24px rgba(66, 133, 244, 0.32);
    }

    #submitBtn:disabled {
        background: #b8c1cc;
        box-shadow: none;
    }

    .selected-count {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.65rem 1rem;
        color: #475569;
        font-weight: 700;
        border-radius: 999px;
        background-color: #f1f5f9;
        transition:
            color 0.25s ease,
            background-color 0.25s ease,
            transform 0.25s ease;
    }

    .selected-count.active {
        color: #2563eb;
        background-color: #dbeafe;
        transform: scale(1.03);
    }

    .toast {
        border-radius: 18px;
        overflow: hidden;
    }

    .toast-header {
        background:
            linear-gradient(
                135deg,
                #4f7cff,
                #8b5cf6
            );
        color: white;
    }

    .toast-header .btn-close {
        filter: invert(1);
    }

    .toast-body {
        font-size: 0.95rem;
        background: white;
    }

    </style>

</head>

<?php
$schedules = require 'moshi_data.php';
?>

<body>

<div class="container py-5">

    <div class="card shadow-sm mb-4">
        <div class="card-body text-center">
            <h1 class="mb-3">
                <i class="fa-solid fa-graduation-cap text-primary"></i>
                模試日程メーカー
            </h1>

            <p class="mb-0">
                模試日程を
                Googleカレンダーへ一括登録できます。
            </p>
        </div>
    </div>

    <form id="scheduleForm"
      action="generate.php"
      method="post">

        <!-- 試験種別 -->
        <div class="card shadow-sm mb-4">
            <div class="card-header">
                <span class="step-badge">STEP 1</span>
                試験種別を選ぶ
            </div>

            <div class="card-body">

                <?php foreach ($schedules as $type => $group): ?>

                <div class="form-check exam-type-card">

                    <input class="form-check-input exam-type"
                        type="checkbox"
                        id="type-<?= $type ?>"
                        data-target="<?= $type ?>-area"
                        <?= $type === 'kawai' ? 'checked' : '' ?>>

                    <label class="form-check-label" for="type-<?= $type ?>">
                        <i class="fa-solid fa-<?= $group['icon'] ?>
                        text-<?= $group['color'] ?>"></i>

                        <?= htmlspecialchars($group['label']) ?>
                    </label>

                </div>

                <?php endforeach; ?>

            </div>
        </div>

        <!-- 登録項目 -->
        <div class="card shadow-sm mb-4">

            <div class="card-header">
                <span class="step-badge">STEP 2</span>
                登録するイベントを選ぶ
            </div>

            <div class="card-body">

                <div class="form-check">
                    <input class="form-check-input"
                           type="checkbox"
                           name="types[]"
                           value="exam"
                           checked>

                    <label class="form-check-label">
                        試験日
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input"
                           type="checkbox"
                           name="types[]"
                           value="start"
                           checked>

                    <label class="form-check-label">
                        申込開始日
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input"
                           type="checkbox"
                           name="types[]"
                           value="end"
                           checked>

                    <label class="form-check-label">
                        申込締切日
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input"
                           type="checkbox"
                           name="types[]"
                           value="score"
                           checked>

                    <label class="form-check-label">
                        成績公開日
                    </label>
                </div>

            </div>
        </div>

        <!-- 試験日選択 -->
        <div class="card shadow-sm mb-4">

            <div class="card-header">
                <span class="step-badge">STEP 3</span>
                受験回を選ぶ
            </div>

            <div class="card-body">

                <div id="selectedCount"
                    class="selected-count mb-3">
                    <i class="fa-solid fa-circle-check"></i>
                    現在 0 件選択中
                </div>

                <?php foreach ($schedules as $type => $group): ?>

                    <div id="<?= $type ?>-area"
                        <?= $type !== 'kawai'
                            ? 'style="display:none;"'
                            : '' ?>>

                        <h5 class="mb-3 <?= $type !== 'kawai' ? 'mt-4' : '' ?>">
                            <i class="fa-solid fa-<?= $group['icon'] ?>
                            text-<?= $group['color'] ?>"></i>

                            <?= htmlspecialchars($group['label']) ?>
                        </h5>

                        <?php foreach ($group['events'] as $key => $event): ?>

                            <?php
                            $date = DateTime::createFromFormat(
                                'Ymd',
                                $event['exam'][0]
                            );

                            $week = [
                                '日',
                                '月',
                                '火',
                                '水',
                                '木',
                                '金',
                                '土'
                            ];

                            $display =
                                $date->format('Y年n月j日')
                                . '('
                                . $week[$date->format('w')]
                                . ')';
                            ?>

                            <div class="form-check exam-event">

                                <input class="form-check-input"
                                    type="checkbox"
                                    name="tests[]"
                                    id="test-<?= $type ?>-<?= $key ?>"
                                    value="<?= $key ?>">

                                <label class="form-check-label"
                                    for="test-<?= $type ?>-<?= $key ?>">

                                    <div>
                                        <?= $display ?>
                                    </div>

                                    <small class="text-muted">
                                        <?= htmlspecialchars(
                                            $event['exam'][1]
                                        ) ?>
                                    </small>

                                </label>

                            </div>

                        <?php endforeach; ?>

                    </div>

                <?php endforeach; ?>

            </div>
        </div>

        <div class="text-center">
            <button id="submitBtn"
                class="btn btn-primary btn-lg w-100"
                disabled>
                <i class="fa-brands fa-google"></i>
                選んだ日程をカレンダーに追加
            </button>
            <div id="message"
                class="text-muted text-center mt-2">
                受験回を1つ以上選択してください。
            </div>
        </div>

    </form>

</div>

<footer class="bg-light py-4 mt-5">
    <div class="container text-center">
        <p class="mb-1">模試日程メーカー</p>
        <small>
            Developed By <a href="https://tsukuba42195.sakura.ne.jp/">Akira Mukai</a> | <a href="https://github.com/s0323861/">GitHub</a>
        </small>
        <p>
            <a href="https://github.com/s0323861/" target="_blank"
               class="btn btn-outline-light mt-3">
                <i class="fab fa-github"></i> GitHub
            </a>
        </p>
    </div>
</footer>

<script>
document.querySelectorAll('.exam-type').forEach(function(checkbox){

    checkbox.addEventListener('change', function(){

        const target =
            document.getElementById(
                this.dataset.target
            );

        if(this.checked){
            target.style.display = 'block';
        }else{
            target.style.display = 'none';

            target.querySelectorAll(
                'input[type="checkbox"]'
            ).forEach(function(cb){
                cb.checked = false;
            });
        }

        updateSubmitButton();

    });

});

document.querySelectorAll(
    'input[name="types[]"]'
).forEach(function(cb) {

    cb.addEventListener(
        'change',
        function() {
            updateSubmitButton();
            updateSelectedCount();
        }
    );

});

function updateSubmitButton() {

    const checkedTests =
        document.querySelectorAll(
            'input[name="tests[]"]:checked'
        );

    const checkedTypes =
        document.querySelectorAll(
            'input[name="types[]"]:checked'
        );

    const submitBtn =
        document.getElementById('submitBtn');

    const message =
        document.getElementById('message');

    if (
        checkedTests.length > 0 &&
        checkedTypes.length > 0
    ) {
        submitBtn.disabled = false;
        message.style.display = 'none';
    } else {
        submitBtn.disabled = true;
        message.style.display = 'block';

        if (checkedTests.length === 0) {
            message.textContent =
                '受験回を1つ以上選択してください。';
        } else {
            message.textContent =
                '登録するイベントを1つ以上選択してください。';
        }
    }
}

function updateSelectedCount() {

    const checkedTests =
        document.querySelectorAll(
            'input[name="tests[]"]:checked'
        );

    const selectedCount =
        document.getElementById('selectedCount');

    const count = checkedTests.length;

    selectedCount.innerHTML =
        '<i class="fa-solid fa-circle-check"></i>' +
        '現在 ' + count + ' 件選択中';

    if (count > 0) {
        selectedCount.classList.add('active');
    } else {
        selectedCount.classList.remove('active');
    }
}

document.querySelectorAll(
    'input[name="tests[]"]'
).forEach(function(cb) {

    cb.addEventListener(
        'change',
        function() {
            updateSubmitButton();
            updateSelectedCount();
        }
    );

});

updateSubmitButton();
updateSelectedCount();

</script>

<div class="toast-container position-fixed top-0 end-0 p-3"
     style="z-index: 9999;">

    <div id="icsToast"
         class="toast border-0 shadow"
         role="alert"
         aria-live="assertive"
         aria-atomic="true">

        <div class="toast-header">

            <i class="fa-solid fa-circle-check
                      text-white me-2"></i>

            <strong class="me-auto">
                ICSファイルを作成しました
            </strong>

            <button type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="toast"
                    aria-label="閉じる">
            </button>

        </div>

        <div class="toast-body">
            🎉 Googleカレンダーへ
            インポートしてください。
        </div>

    </div>

</div>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js">
</script>

<script>
document
    .getElementById('scheduleForm')
    .addEventListener('submit', function() {

        const toastElement =
            document.getElementById('icsToast');

        const toast =
            bootstrap.Toast.getOrCreateInstance(
                toastElement,
                {
                    delay: 4000
                }
            );

        toast.show();
    });
</script>

</body>
</html>