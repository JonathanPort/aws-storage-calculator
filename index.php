<!DOCTYPE html>
<html>
<head>
	<title>AWS Calculator</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<style type="text/css">
		.h1 {
			margin-top: 10px;
			margin-bottom: 10px;
		}

		.inputs {
			display: flex;
			align-items: flex-end;
		}

		.input-wrap {
			margin-right: 20px;
		}

		input {
			display: block;
			width: 100%;
		}

		.content {
			margin-top: 40px;
		}

		.content div {
			font-size: 20px;
			margin-bottom: 10px;
		}
	</style>

</head>
<body>

	<main>
		<div class="container">

			<h1 class="h1">AWS Cost Calc Per User</h1>

			<div class="inputs">
				<div class="input-wrap">
					<label>Amount of users</label>
					<input type="number" name="user_amount" min="10000" max="100000000" step="10000" value="10000">
				</div>

				<div class="input-wrap">
					<label>File count per user (Images, Videos & misc files e.g. pdfs etc)</label>
					<input type="number" name="file_count" min="1" max="1000" step="1" value="10">
				</div>

				<div class="input-wrap">
					<label>Avarage file size (mb)</label>
					<input type="number" name="file_size" min="0.1" max="100" step="0.1" value="0.5">
				</div>

				<div class="input-wrap">
					<button class="submit">Calculate</button>
				</div>
			</div>

			<div class="content"></div>

		</div>
	</main>

	<script type="text/javascript">

		window.addEventListener('DOMContentLoaded', function () {


			var inputUserCount = document.querySelector('input[name="user_amount"]'),
				inputFileCount = document.querySelector('input[name="file_count"]'),
				inputFileSize = document.querySelector('input[name="file_size"]'),
				submit = document.querySelector('.submit'),
				contentContainer = document.querySelector('.content'),
				awsPricePerMb = 0.023,
				totalMbPerUser,
				totalMbAllUsers,
				totalGb;

			var totalMbPerUserEl,
				totalMbAllUsersEl,
				totalGbEl,
				totalCostDollarsEl;

			submit.addEventListener('click', function (e) {

				e.preventDefault();

				totalMbPerUser = inputFileSize.value * inputFileCount.value;
				totalMbAllUsers = totalMbPerUser * inputUserCount.value;
				totalGb = totalMbAllUsers / 1024;
				totalCostDollars = 0.023 * totalGb;

				contentContainer.innerHTML = '';

				totalMbPerUserEl = document.createElement('div');
				totalMbPerUserEl.innerHTML = 'MB Total per User: ' + totalMbPerUser + 'mb';

				totalMbAllUsersEl = document.createElement('div');
				totalMbAllUsersEl.innerHTML = 'MB Total for All Users: ' + totalMbAllUsers + 'mb / ' + Math.round(totalGb * 100) / 100 + 'gb';

				totalCostDollarsEl = document.createElement('div');
				totalCostDollarsEl.innerHTML = 'Total cost per month: $' + Math.round(totalCostDollars * 100) / 100 + ' ($' + awsPricePerMb + ' per GB)';


				contentContainer.appendChild(totalMbPerUserEl);
				contentContainer.appendChild(totalMbAllUsersEl);
				contentContainer.appendChild(totalCostDollarsEl);

			});


		});

	</script>

</body>
</html>