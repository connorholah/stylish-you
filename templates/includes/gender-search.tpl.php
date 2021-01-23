<div class="container">

	<?php if ((isset($_POST['isSent'])) && (empty($validation) == false)): ?>
		<div class="alert">
			<?php foreach($validation as $message): ?>
				<p><?php Cerbarus::echoEscaped($message); ?></p>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>


	<?php if ((isset($_POST['isSent']) == false) || (empty($validation) == false) || (empty($searchResults) == true)): ?>
		<form action="" method="post">
		
			<div class="input-group">
				<label for="productType">Product Type</label>
				<select name="productType" required>
					<option selected disabled>Choose</option>
					<?php foreach ($allProductTypes as $productType): ?>
						<option value="<?php Cerbarus::echoEscaped($productType['o_productType']); ?>"><?php Cerbarus::echoEscaped($productType['o_productType']); ?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<div class="input-group">
				<label for="productSize">Size</label>
				<select name="productSize">
					<option selected disabled>Choose</option>
						<option value="S">S</option>
						<option value="M">M</option>
						<option value="L">L</option>
						<option value="XL">XL</option>
						<option value="XXL">XXL</option>
						<option value="6">6</option>
						<option value="6.5">6.5</option>
						<option value="7">7</option>
						<option value="7.5">7.5</option>
						<option value="8">8</option>
						<option value="8.5">8.5</option>
						<option value="9">9</option>
						<option value="9.5">9.5</option>
						<option value="10">10</option>
						<option value="10.5">10.5</option>
						<option value="11">11</option>
						<option value="12">12</option>
						<option value="13">13</option>
				</select>
			</div>

			<div class="input-group">
				<label for="productColour">Colour</label>
				<select name="productColour">
					<option selected disabled>Choose</option>
					<?php foreach ($allProductColours as $productColour): ?>
						<option value="<?php Cerbarus::echoEscaped($productColour['o_colour']); ?>"><?php Cerbarus::echoEscaped($productColour['o_colour']); ?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<div class="input-group">
				<label for="productMinPrice">Price</label>
				<input name="productMinPrice" type="text" placeholder="Minimum Price">
				<input name="productMaxPrice" type="text" placeholder="Maximum Price">
			</div>

			<div class="input-group">
				<label for="productBrand">Brand</label>
				<select name="productBrand">
					<option selected disabled>Choose</option>
					<?php foreach ($allProductBrands as $productBrand): ?>
						<option value="<?php Cerbarus::echoEscaped($productBrand['o_brand']); ?>"><?php Cerbarus::echoEscaped($productBrand['o_brand']); ?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<div class="input-group">
				<label for="productLocation">Store</label>
				<select name="productLocation">
					<option selected disabled>Choose</option>
					<?php foreach ($allProductLocations as $productLocation): ?>
						<option value="<?php Cerbarus::echoEscaped($productLocation['o_location']); ?>"><?php Cerbarus::echoEscaped($productLocation['o_location']); ?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<div style="display: flex; flex-wrap: wrap;">
				<button style="text-align: center;" class="button <?php Cerbarus::echoEscaped($_GET['type']); ?>" type="submit">Find</button>
				<a href="/index.php" style="text-align: center;" class="button <?php Cerbarus::echoEscaped($_GET['type']); ?>"><< Home</a>
			</div>

			<input type="hidden" name="isSent">

		</form>
	<?php endif; ?>


	<?php if ((isset($_POST['isSent'])) && (empty($validation) == true) && (empty($searchResults) == false)): ?>

		<table class="searchResultTable">
			<thead class="<?php Cerbarus::echoEscaped($_GET['type']); ?>">
				<tr>
					<th>Product Description</th>
					<th>Brand</th>
					<th>Qty</th>
					<th>Store</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($searchResults as $searchResult): ?>
					<tr>
						<td><?php Cerbarus::echoEscaped($searchResult['o_productDescription']); ?></td>
						<td><?php Cerbarus::echoEscaped($searchResult['o_brand']); ?></td>
						<td><?php Cerbarus::echoEscaped($searchResult['o_quantity']); ?></td>
						<td><?php Cerbarus::echoEscaped($searchResult['o_location']); ?></td>
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>

		<div style="display: flex; flex-wrap: nowrap; width: 100%;">
			<a href="/search.php?type=<?php echo $_GET['type']; ?>" style="text-align: center;" class="button <?php echo $_GET['type']; ?>"><< Back</a>
			<a href="/index.php" style="text-align: center; margin-left: 3em;" class="button <?php echo $_GET['type']; ?>">Home</a>
		</div>

	<?php elseif(isset($_POST['isSent']) && (empty($searchResults))): ?>

		<p>Your search returned no results, perhaps try broadening your search parameters.</p>

	<?php endif; ?>


</div>