<?php

define('BA_PAGE_EDITABLE', author_can_edit(ADMIN_TO));

if (BA_PAGE_EDITABLE) dynamic_tools_add();

