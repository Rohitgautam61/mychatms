<?php require('header_php.php')?>
<style>
    .content-wrapper {
        display: flex;
        justify-content: space-between;
        padding: 20px;
        margin-top: 75px;
        margin-bottom: 75px;

    }
    .content-container {
        width: 48%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h2 {
        text-align: center;
        color: #333;
    }
    h3 {
        color: #0056b3;
    }
    p {
        margin: 5px 0;
    }
    code {
        background-color: #f1f1f1;
        padding: 2px 4px;
        border-radius: 3px;
    }
</style>
<div class="content-wrapper">
<div class="content-container">
                <h2>Input Types Explanation (English)</h2>
                <h3>Format 1: 01-10</h3>
                <p>Output: <code>01, 02, 03, 04, 05, 06, 07, 08, 09, 10</code></p>
                <h3>Format 2: 12233445566711</h3>
                <p>Output: <code>12, 23, 34, 45, 56, 67, 11</code></p>
                <h3>Format 3: a01234/A01234</h3>
                <p>Output: <code>A0, A1, A2, A3, A4</code></p>
                <h3>Format 4: b01234/B01234</h3>
                <p>Output: <code>B0, B1, B2, B3, B4</code></p>
                <h3>Format 5: AB012/ab012</h3>
                <p>Output: <code>A0, A1, A2, B0, B1, B2</code></p>
                <h3>Format 6: 123/123</h3>
                <p>Output: <code>11, 12, 13, 21, 22, 23, 31, 32, 33</code></p>
                <h3>Format 7: j123/123, J123/123</h3>
                <p>Output: <code>12, 13, 21, 23, 31, 32</code></p>
                <h3>Format 8: 122333345566711*33</h3>
                <p>Output: <code>12, 23, 34, 45, 56, 67, 11</code> (without 33)</p>
            </div>

            <!-- Hindi Section -->
            <div class="content-container">
                <h2>इनपुट प्रकारों की व्याख्या (हिंदी)</h2>
                <h3>प्रारूप 1: 01-10</h3>
                <p>आउटपुट: <code>01, 02, 03, 04, 05, 06, 07, 08, 09, 10</code></p>
                <h3>प्रारूप 2: 12233445566711</h3>
                <p>आउटपुट: <code>12, 23, 34, 45, 56, 67, 11</code></p>
                <h3>प्रारूप 3: a01234/A01234</h3>
                <p>आउटपुट: <code>A0, A1, A2, A3, A4</code></p>
                <h3>प्रारूप 4: b01234/B01234</h3>
                <p>आउटपुट: <code>B0, B1, B2, B3, B4</code></p>
                <h3>प्रारूप 5: AB012/ab012</h3>
                <p>आउटपुट: <code>A0, A1, A2, B0, B1, B2</code></p>
                <h3>प्रारूप 6: 123/123</h3>
                <p>आउटपुट: <code>11, 12, 13, 21, 22, 23, 31, 32, 33</code></p>
                <h3>प्रारूप 7: j123/123, J123/123</h3>
                <p>आउटपुट: <code>12, 13, 21, 23, 31, 32</code></p>
                <h3>प्रारूप 8: 122333345566711*33</h3>
                <p>आउटपुट: <code>12, 23, 34, 45, 56, 67, 11</code> (बिना 33 के)</p>
            </div>
        </div>
<?php require('footer.php') ?>